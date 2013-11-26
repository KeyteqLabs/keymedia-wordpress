<div class="wrap" ng-app="keymediaSettingsApp">
    <div ng-controller="SettingsCtrl">
        <h2>
            <?php echo __('KeyMedia integration settings'); ?>
        </h2>
        <div class="error" ng-hide="connection || !settings.token">
            <p><?php echo __('Cannot connect to KeyMedia with current settings'); ?></p>
        </div> 
        <div class="updated" ng-show="connection && keymedia_settings.$pristine">
            <p><?php echo __('Current settings are correct'); ?></p>
        </div> 
        <form id="keymedia_settings" name="keymedia_settings" method="post" action="options.php" ng-submit="removePassword()">
            <p>
                <?php settings_fields('keymedia_settings'); ?>
                <?php do_settings_sections('keymedia_settings'); ?>
            </p>
            <p>
                <input ng-click="submit()" id="save_keymedia_options" class="button button-primary" type="button" name="Submit" value="<?php esc_attr_e('Connect to KeyMedia') ?>" />
            </p>
        </form>
    </div>
</div>

<script src="<?php echo plugins_url('../web/app/bower_components/angular/angular.min.js', __FILE__); ?>"></script>
<script src="<?php echo plugins_url('../web/app/scripts/settings.js', __FILE__); ?>"></script>
