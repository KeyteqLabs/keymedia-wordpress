<?php

// Initializing API
use Keyteq\Keymedia\KeymediaClient;
$options = get_option('keymedia_settings');
$apiUser = $options['keymedia_username'];
$apiKey  = $options['keymedia_token'];
$apiHost = $options['keymedia_host'];

$api = new KeymediaClient($apiUser, $apiKey, $apiHost);

// It's not a good idea for API to return JSON instead of arrays
$media = $api->listMedia();
// Until there is in API another way to get media we have to rewrite them this way
echo json_encode($media);

exit();
