<?php

if (!empty($_GET['photo_id'])) {
  $photo = new ent_gallery($_GET['photo_id']);
} else {
  $photo = new ent_gallery();
}

if (empty($_POST)) {
  $_POST = $photo->data;
}

document::$snippets['title'][] = !empty($photo->data['id']) ? language::translate('title_edit_photo', 'Izmjeni Sliku') : language::translate('title_add_new_photo', 'Dodaj Novu Sliku');

breadcrumbs::add(language::translate('title_gallery', 'gallery'), document::link(WS_DIR_ADMIN, ['doc' => 'gallery'], ['app']));
breadcrumbs::add(!empty($photo->data['id']) ? language::translate('title_edit_dj', 'Izmjeni DJ') : language::translate('title_add_photo', 'Dodaj Novu Sliku'));

if (isset($_POST['save'])) {

  try {

    if (empty($_POST['name'])) throw new Exception(language::translate('error_must_enter_name', 'You must enter a name'));

    if (!empty($_FILES['image']['error'])) {
      throw new Exception(language::translate('error_uploaded_image_rejected', 'An uploaded image was rejected for unknown reason'));
    }

    if (empty($_POST['status'])) $_POST['status'] = 0;
    if (empty($_POST['languages'])) $_POST['languages'] = [];

    $fields = [
      'status',
      'user_id',
      'languages',
      'name',
      'caption',
      'link',
      'priority',
      'date_valid_from',
      'date_valid_to',
    ];

    foreach ($fields as $field) {
      if (isset($_POST[$field])) $photo->data[$field] = $_POST[$field];
    }

    if (!empty($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
      $photo->save_image($_FILES['image']['tmp_name']);
    }

    $photo->save();

    notices::add('success', language::translate('success_changes_saved', 'Changes saved'));
    header('Location: ' . document::link(WS_DIR_ADMIN, ['doc' => 'gallery'], true, ['action', 'photo_id']));
    exit;
  } catch (Exception $e) {
    notices::add('errors', $e->getMessage());
  }
}

if (isset($_POST['delete'])) {

  try {
    if (empty($photo->data['id'])) throw new Exception(language::translate('error_must_provide_dj', 'You must provide a DJ'));

    $photo->delete();

    notices::add('success', language::translate('success_changes_saved', 'Changes saved'));
    header('Location: ' . document::link(WS_DIR_ADMIN, ['doc' => 'gallery'], true, ['action', 'photo_id']));
    exit;
  } catch (Exception $e) {
    notices::add('errors', $e->getMessage());
  }
}
?>
<div class="panel panel-app">
  <div class="panel-heading">
    <?php echo $app_icon; ?> <?php echo !empty($photo->data['id']) ? language::translate('title_edit_photo', 'Izmjeni Sliku') : language::translate('title_add_photo', 'Dodaj Novu Sliku'); ?>
  </div>
  <div class="panel-body">
    <?php echo functions::form_draw_form_begin('gallery_form', 'post', false, true, 'style="max-width: 640px;"'); ?>
    <div class="row">
      <div class="form-group col-md-6">
        <label><?php echo language::translate('title_status', 'Status'); ?></label>
        <?php echo functions::form_draw_toggle('status', (file_get_contents('php://input') != '') ? true : '1', 'e/d'); ?>
      </div>

      <div class="form-group col-md-6">
        <label><?php echo language::translate('title_name', 'Name'); ?></label>
        <?php echo functions::form_draw_text_field('name', true); ?>
      </div>
    </div>



    <?php if (!empty($photo->data['image'])) echo '<p><img src="' . document::href_link('images/' . $photo->data['image']) . '" alt="" class="img-responsive" /></p>'; ?>

    <div class="form-group">
      <label><?php echo language::translate('title_image', 'Image'); ?></label>
      <?php echo functions::form_draw_file_field('image'); ?>
      <?php echo (!empty($photo->data['image'])) ? '</label>' . $photo->data['image'] : ''; ?>
    </div>





    <div class="row">
      <div class="form-group col-md-6">
        <label><?php echo language::translate('title_date_valid_from', 'Date Valid From'); ?></label>
        <?php echo functions::form_draw_datetime_field('date_valid_from', true); ?>
      </div>

      <div class="form-group col-md-6">
        <label><?php echo language::translate('title_date_valid_to', 'Date Valid To'); ?></label>
        <?php echo functions::form_draw_datetime_field('date_valid_to', true); ?>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-md-3">
        <label><?php echo language::translate('title_priority', 'Priority'); ?></label>
        <?php echo functions::form_draw_number_field('priority', true); ?>
      </div>
    </div>

    <div class="panel-action btn-group">
      <?php echo functions::form_draw_button('save', language::translate('title_save', 'Save'), 'submit', '', 'save'); ?>
      <?php echo functions::form_draw_button('cancel', language::translate('title_cancel', 'Cancel'), 'button', 'onclick="history.go(-1);"', 'cancel'); ?>
      <?php echo (isset($photo->data['id'])) ? functions::form_draw_button('delete', language::translate('title_delete', 'Delete'), 'submit', 'formnovalidate onclick="if (!window.confirm(\'' . language::translate('text_are_you_sure', 'Are you sure?') . '\')) return false;"', 'delete') : false; ?>
    </div>

    <?php echo functions::form_draw_form_end(); ?>
  </div>
</div>

<script>
  $('input[name^="caption"]').on('input', function(e) {
    var language_code = $(this).attr('name').match(/\[(.*)\]$/)[1];
    $('.nav-tabs a[href="#' + language_code + '"]').css('opacity', $(this).val() ? 1 : .5);
    $('input[name="head_title[' + language_code + ']"]').attr('placeholder', $(this).val());
  }).trigger('input');
</script>