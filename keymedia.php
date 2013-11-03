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

require __DIR__.'/src/KeymediaConfiguration.php';

$configuration = new KeymediaConfiguration();

function keymedia_render_settings() {
    require('views/settings.php');
}

function keymedia_admin_menu() {
    add_menu_page( 'KeyMedia settings', 'KeyMedia', 'administrator', 'KeyMediaSettings', 'keymedia_render_settings', null, 999); 
}
register_deactivation_hook( __FILE__, array($configuration, 'purge') );
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

// RPC endpoint for the front-end app

// WordPress doesn't support PSR-0, so we need an autoloader
require_once __DIR__.'/vendor/autoload.php';

if (isset($_GET['rest'])) {
    require 'process_request.php';
}
