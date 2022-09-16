<div class="box2">

  <h1><span><?php echo language::translate('title_site_meni_contact', 'Kontakt'); ?></span></h1>

  <div class="row">
    <div class="span7">


      {snippet:notices}





    </div>

  </div>


  <h2><?php echo language::translate('title_site_meni_contact_form', 'Kontakt Forma'); ?></h2>

  <div id="note"></div>
  <div id="fields">
    <?php echo $content; ?>
    <form id="ajax-contact-form" class="form-horizontal" action="javascript:alert('success!');">
      <div class="clearfix cform_blocks">

      </div>