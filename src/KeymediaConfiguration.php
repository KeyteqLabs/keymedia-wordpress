<?php

class KeymediaConfiguration {

    private $options;

    public function getOptions() {
        return $this->options;
    }

    public function register_settings() {
        register_setting('keymedia_settings', 'keymedia_settings');
        add_settings_section('keymedia_access', 'KeyMedia access', array($this, 'render_access'), 'keymedia_settings');
        add_settings_field('keymedia_host', 'Host', array($this, 'render_host_field'), 'keymedia_settings', 'keymedia_access');
        add_settings_field('keymedia_username', 'Username', array($this, 'render_username_field'), 'keymedia_settings', 'keymedia_access');
        add_settings_field('keymedia_password', 'Password', array($this, 'render_password_field'), 'keymedia_settings', 'keymedia_access');
        add_settings_field('keymedia_token', 'Token', array($this, 'render_token_field'), 'keymedia_settings', 'keymedia_access');

        $this->options = get_option('keymedia_settings');
        if (!$this->isEmpty()) {
            add_filter('media_upload_tabs', 'keymedia_upload_tab');
        }
    }

    public function render_access() {
        echo '<p>' . __('Your KeyMedia installation host, username and access token') . '</p>';
    }

    public function render_host_field() {
        echo "<input "
                . "ng-model='settings.host' "
                . "required "
                . "ng-initial "
                . "id='keymedia_host' "
                . "name='keymedia_settings[keymedia_host]' "
                . "type='url' "
                . "value='{$this->options['keymedia_host']}' />";
    }

    public function render_username_field() {
        echo "<input "
                . "ng-model='settings.username' "
                . "required "
                . "ng-initial "
                . "id='keymedia_username' name='keymedia_settings[keymedia_username]' "
                . "type='text' "
                . "value='{$this->options['keymedia_username']}' />";
    }
    
    public function render_password_field() {
        echo '<input type="password" ng-model="settings.password" />';
    }

    public function render_token_field() {
        echo "<input "
                . "ng-model='settings.token' "
                . "required "
                . "ng-initial "
                . "id='keymedia_token' name='keymedia_settings[keymedia_token]' "
                . "type='text' "
                . "value='{$this->options['keymedia_token']}' />";
        echo '<input type="button" ng-click="getToken()" value="Get token" />';
    }

    public function isEmpty() {
        return
                empty($this->options['keymedia_host']) ||
                empty($this->options['keymedia_username']) ||
                empty($this->options['keymedia_token']);
    }

    public function purge() {
        delete_option('keymedia_settings');
    }

}
