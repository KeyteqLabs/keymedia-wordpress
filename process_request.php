<?php

// Initializing API
use Keyteq\Keymedia\KeymediaClient;
$options = get_option('keymedia_settings');
$apiUser = $options['keymedia_username'];
$apiKey  = $options['keymedia_token'];
$apiHost = $options['keymedia_host'];

$client = new KeymediaClient($apiUser, $apiKey, $apiHost);

switch($_GET['rest']) {
  case 'list_media':  $response = $client->findMedia('a'); break;
  case 'list_albums': $response = $client->listAlbums(); break;
  case 'get_details': $response = $client->listMedia(); break;
}
// Until there is in API another way to get media we have to rewrite them this way
echo json_encode($response);

exit();
