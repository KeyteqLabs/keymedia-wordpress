<div class="wrap" ng-app="keymediaSettingsApp">
    <div ng-controller="SettingsCtrl">
        <h2>
            <?php echo __('KeyMedia integration settings'); ?>
        </h2>
        <p ng-hide="connection">
            <?php echo __('Cannot connect to KeyMedia. Check your credentials.'); ?>
        </p> 
        <form name="keymedia_settings" method="post" 
              action="options.php">
            <p>
                <?php settings_fields('keymedia_settings'); ?>
                <?php do_settings_sections('keymedia_settings'); ?>
            </p>
            <p>
                <input ng-disabled="!keymedia_settings.$valid || !connection" id="save_keymedia_options" class="button button-primary" type="button" name="Submit" value="<?php esc_attr_e('Save changes') ?>" />
            </p>
        </form>
    </div>
</div>

<script src="<?php echo plugins_url('../web/app/bower_components/angular/angular.min.js', __FILE__); ?>"></script>
<script src="<?php echo plugins_url('../web/app/scripts/settings.js', __FILE__); ?>"></script>
