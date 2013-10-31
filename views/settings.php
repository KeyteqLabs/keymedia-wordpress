<script>
// Inside WordPress layout, can't use angular.
jQuery(function(){
    jQuery('#save_keymedia_options').on('click', function(){
      jQuery.getJSON('media-upload.php?tab=keymedia&rest=check_connection', {
          'username': jQuery('#keymedia_username').val(),
          'host':     jQuery('#keymedia_host').val(),
          'token':    jQuery('#keymedia_token').val()
      }).done(function(data) {
          if(data) {
              jQuery('form:first').submit();
          } else {
              jQuery('#connection_failed').show();
          }
      });
    });
});
</script>

<div class="wrap">
    <h2>
        <?php echo __('KeyMedia integration settings'); ?>
    </h2>
    <p id="connection_failed" style="display:none">
        <?php echo __('Cannot connect to KeyMedia. Check your credentials.'); ?>
    </p> 
    <form name="keymedia_settings" method="post" 
          action="options.php">
        <p>
            <?php settings_fields('keymedia_settings'); ?>
            <?php do_settings_sections('keymedia_settings'); ?>
        </p>
        <p>
            <input id="save_keymedia_options" class="button button-primary" type="button" name="Submit" value="<?php esc_attr_e('Save changes') ?>" />
        </p>
    </form>
</div>
