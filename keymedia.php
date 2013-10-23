<?php

/* Plugin Name: KeyMedia
  Plugin URI: http://keymedia.no
  Description: KeyMedia integration for Media Library
  Version: 0.1
  Author: Keyteq
  Author URI: http://keyteq.no
  License: MIT
 */

// Settings

class KeyMediaConfiguration {

    private $options;

    public function getOptions() {
        return $this->options;
    }

    public function register_settings() {
        register_setting('keymedia_settings', 'keymedia_settings');
        add_settings_section('keymedia_access', 'KeyMedia access', array($this, 'render_access'), 'keymedia_settings');
        add_settings_field('keymedia_host', 'Host', array($this, 'render_host_field'), 'keymedia_settings', 'keymedia_access');
        add_settings_field('keymedia_username', 'Username', array($this, 'render_username_field'), 'keymedia_settings', 'keymedia_access');
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
        echo "<input id='plugin_text_string' name='keymedia_settings[keymedia_host]' type='text' value='{$this->options['keymedia_host']}' />";
    }

    public function render_username_field() {
        echo "<input id='plugin_text_string' name='keymedia_settings[keymedia_username]' type='text' value='{$this->options['keymedia_username']}' />";
    }

    public function render_token_field() {
        echo "<input id='plugin_text_string' name='keymedia_settings[keymedia_token]' type='text' value='{$this->options['keymedia_token']}' />";
    }

    public function isEmpty() {
        return
                empty($this->options['keymedia_host']) ||
                empty($this->options['keymedia_username']) ||
                empty($this->options['keymedia_token']);
    }

}

$configuration = new KeyMediaConfiguration();

function keymedia_render_settings() {
    require('views/settings.php');
}

function keymedia_admin_menu() {
    add_options_page('KeyMedia settings', 'KeyMedia', 'administrator', 'KeyMediaSettings', 'keymedia_render_settings');
}

add_action('admin_init', array($configuration, 'register_settings'));
add_action('admin_menu', 'keymedia_admin_menu');

// Media library tab
function keymedia_upload_tab($tabs) {
    $tabs['keymedia'] = _('Insert from KeyMedia');
    return $tabs;
}

function keymedia_upload_tab_content() {
    require('web/app/media_browser.php');
}

add_action('media_upload_keymedia', 'keymedia_upload_tab_content');

// RESTful endpoint for the front-end app
// 
// WordPress doesn't support PSR-0, so we need an autoloader
function autoload($className) {
    $className = str_replace('\\', '/', $className);
    $file = __DIR__.'/vendor/KeyteqLabs/keymedia-php/src/' . $className . '.php';
    if(file_exists($file))
        require ($file);
}

spl_autoload_register('autoload', false, true);

if (isset($_GET['rest'])) {
    require 'process_request.php';
}