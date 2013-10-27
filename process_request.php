<?php

// Initializing API
use Keyteq\Keymedia\KeymediaClient;

$options = get_option('keymedia_settings');
$apiUser = $options['keymedia_username'];
$apiKey  = $options['keymedia_token'];
$apiHost = preg_replace('#^https?://#', '', $options['keymedia_host']);

$client = new KeymediaClient($apiUser, $apiKey, $apiHost);

$search = isset($_GET['search']) ? $_GET['search'] : '.';
$album  = isset($_GET['album'])  ? $_GET['album'] : null;

switch($_GET['rest']) {
  case 'list_media':  
    if($album) { // TODO: Have one method for this. Ask Kuba to pull it together with this API.
      $response = $client->getAlbum($album, $search);
    } else {
      $response = $client->findMedia($search); // FIXME: Why was the find all method removed?
    }
    break;
  case 'list_albums': $response = $client->listAlbums(); break;
}

echo json_encode($response);
exit();
