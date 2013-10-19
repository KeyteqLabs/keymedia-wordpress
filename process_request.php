<?php

// This file is supposed to be a thin wrapper for API methods
// Unfortunately only one of those methods exist, hence the cruft.

// WordPress doesn't support PSR-0, so we need an autoloader
function autoload($className) {
    $className = str_replace('\\', '/', $className);
    include ('vendor/KeyteqLabs/keymedia-php/src/' . $className . '.php');
}

spl_autoload_register('autoload');

// Initializing API
use Keyteq\Keymedia\API;
$options = get_option('keymedia_settings');
$apiUser = $options['keymedia_username'];
$apiKey  = $options['keymedia_token'];
$apiHost = $options['keymedia_host'];

$api = new API($apiUser, $apiKey, $apiHost);

// It's not a good idea for API to return JSON instead of arrays
$media = json_decode($api->listMedia(), true);

// Until there is in API another way to get media we have to rewrite them this way
$mediaExt = array();
foreach ($media as $mediumDir) {
    if (is_array($mediumDir)) {
        foreach ($mediumDir as $medium) {
            $url = strpos($medium['host'], 'http://') === 0 ? $medium['host'] :
                'http://'.$medium['host'];
            $url .= $medium['shareUrl'];
            $mediaExt[] = array(
                // Lots of metadata is missing here, API should handle this part
                'name' => $medium['name'],
                'url' => $url
            );
        }
    }
}

echo json_encode($mediaExt);

exit();