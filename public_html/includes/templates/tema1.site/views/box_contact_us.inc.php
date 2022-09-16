<?php echo functions::form_draw_form_begin('contact_form', 'post'); ?>
<div class="block1">
  <div class="control-group">
    <label class="control-label" for="inputName"><?php echo language::translate('title_name', 'Name'); ?></label>
    <div class="controls">
      <input class="" type="text" id="inputName" name="name" value="Your full name:" onBlur="if(this.value=='') this.value='Your full name:'" onFocus="if(this.value =='Your full name:' ) this.value=''">
    </div>
  </div>
</div>
<div class="block2">
  <div class="control-group">
    <label class="control-label" for="inputEmail"><?php echo language::translate('title_email_address', 'Email Address'); ?></label>
    <div class="controls">
      <input class="" type="text" id="inputEmail" name="email" value="Your email:" onBlur="if(this.value=='') this.value='Your email:'" onFocus="if(this.value =='Your email:' ) this.value=''">
    </div>
  </div>
</div>
<div class="block3">
  <div class="control-group">
    <label class="control-label" for="inputPhone"><?php echo language::translate('title_subject', 'Subject'); ?></label>
    <div class="controls">
      <input class="" type="text" id="inputPhone" name="subject" value="Subject:">
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="span10">
    <div class="control-group">
      <label class="control-label" for="inputMessage"><?php echo language::translate('title_message', 'Message'); ?></label>
      <div class="controls">
        <textarea class="span10" id="inputMessage" name="message" onBlur="if(this.value=='') this.value='Message:'" onFocus="if(this.value =='Message:' ) this.value=''">Message:</textarea>
      </div>
    </div>
  </div>
</div>
<?php if (settings::get('captcha_enabled')) { ?>
  <div class="row">
    <div class="form-group col-md-6">
      <label><?php echo language::translate('title_captcha', 'CAPTCHA'); ?></label>
      <?php echo functions::form_draw_captcha_field('captcha', 'contact_us', 'required="required"'); ?>
    </div>
  </div>
<?php } ?>
<?php echo functions::form_draw_button('send', language::translate('title_send', 'Send'), 'submit', 'style="font-weight: bold;"'); ?>
<?php echo functions::form_draw_form_end(); ?>