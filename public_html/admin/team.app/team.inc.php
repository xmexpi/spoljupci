<?php
if (empty($_GET['page']) || !is_numeric($_GET['page'])) $_GET['page'] = 1;

document::$snippets['title'][] = language::translate('title_team', 'Ekipa Radia');

breadcrumbs::add(language::translate('title_team', 'Ekipa Radia'));

if (isset($_POST['enable']) || isset($_POST['disable'])) {

  try {
    if (empty($_POST['djs'])) throw new Exception(language::translate('error_must_select_Ekipa Radija', 'You must select Ekipa Radija'));

    foreach ($_POST['djs'] as $dj_id) {
      $dj = new ent_team($dj_id);
      $dj->data['status'] = !empty($_POST['enable']) ? 1 : 0;
      $dj->save();
    }

    notices::add('success', language::translate('success_changes_saved', 'Changes saved'));
    header('Location: ' . document::link());
    exit;
  } catch (Exception $e) {
    notices::add('errors', $e->getMessage());
  }
}

// Table Rows
$team = [];

$team_query = database::query(
  "select * from " . DB_TABLE_PREFIX . "team
    order by status desc, priority, name;"
);

if ($_GET['page'] > 1) database::seek($team_query, settings::get('data_table_rows_per_page') * ($_GET['page'] - 1));

$page_items = 0;
while ($dj = database::fetch($team_query)) {
  $team[] = $dj;
  if (++$page_items == settings::get('data_table_rows_per_page')) break;
}

// Number of Rows
$num_rows = database::num_rows($team_query);

// Pagination
$num_pages = ceil($num_rows / settings::get('data_table_rows_per_page'));
?>

<div class="panel panel-app">
  <div class="panel-heading">
    <?php echo $app_icon; ?> <?php echo language::translate('title_Ekipa Radija', 'Ekipa Radija'); ?>
  </div>

  <div class="panel-action">
    <ul class="list-inline">
      <li><?php echo functions::form_draw_link_button(document::link(WS_DIR_ADMIN, ['doc' => 'edit_dj'], true), language::translate('title_add_dj', 'Dodaj DJ'), '', 'add'); ?></li>
    </ul>
  </div>

  <div class="panel-body">
    <?php echo functions::form_draw_form_begin('Ekipa Radija_form', 'post'); ?>

    <table class="table table-striped table-hover data-table">
      <thead>
        <tr>
          <th><?php echo functions::draw_fonticon('fa-check-square-o fa-fw checkbox-toggle', 'data-toggle="checkbox-toggle"'); ?></th>
          <th></th>
          <th><?php echo language::translate('title_id', 'ID'); ?></th>
          <th class="main"><?php echo language::translate('title_name', 'Name'); ?></th>
          <th class="text-center"><?php echo language::translate('title_valid_from', 'Valid From'); ?></th>
          <th class="text-center"><?php echo language::translate('title_valid_to', 'Valid To'); ?></th>
          <th><?php echo language::translate('title_priority', 'Priority'); ?></th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($team as $dj) { ?>
          <tr class="<?php echo empty($dj['status']) ? 'semi-transparent' : null; ?>">
            <td><?php echo functions::form_draw_checkbox('djs[]', $dj['id']); ?></td>
            <td><?php echo functions::draw_fonticon('fa-circle', 'style="color: ' . (!empty($dj['status']) ? '#88cc44' : '#ff6644') . ';"'); ?></td>
            <td><?php echo $dj['id']; ?></td>
            <td><a href="<?php echo document::href_link('', ['doc' => 'edit_dj', 'team_id' => $dj['id']], true); ?>"><?php echo $dj['name']; ?></a></td>
            <td class="text-end"><?php echo !empty($dj['date_valid_from']) ? language::strftime(language::$selected['format_datetime'], strtotime($dj['date_valid_from'])) : '-'; ?></td>
            <td class="text-end"><?php echo !empty($dj['date_valid_to']) ? language::strftime(language::$selected['format_datetime'], strtotime($dj['date_valid_to'])) : '-'; ?></td>
            <td class="text-end"><?php echo $dj['priority']; ?></td>
            <td class="text-end"><a href="<?php echo document::href_link('', ['doc' => 'edit_dj', 'team_id' => $dj['id']], true); ?>" title="<?php echo language::translate('title_edit', 'Edit'); ?>"><?php echo functions::draw_fonticon('fa-pencil'); ?></a></td>
          </tr>
        <?php } ?>
      </tbody>

      <tfoot>
        <tr>
          <td colspan="9"><?php echo language::translate('title_team', 'Ekipa Radija'); ?>: <?php echo $num_rows; ?></td>
        </tr>
      </tfoot>
    </table>

    <div class="btn-group">
      <?php echo functions::form_draw_button('enable', language::translate('title_enable', 'Enable'), 'submit', '', 'on'); ?>
      <?php echo functions::form_draw_button('disable', language::translate('title_disable', 'Disable'), 'submit', '', 'off'); ?>
    </div>

    <?php echo functions::form_draw_form_end(); ?>
  </div>

  <div class="panel-footer">
    <?php echo functions::draw_pagination($num_pages); ?>
  </div>
</div>