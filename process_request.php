<?php

// Initializing API
use Keyteq\Keymedia\KeymediaClient;

$options = get_option('keymedia_settings');
$apiUser = $options['keymedia_username'];
$apiKey  = $options['keymedia_token'];
$apiHost = 'http://'.preg_replace('#^https?://#', '', $options['keymedia_host']);//FIXME

$client = new KeymediaClient($apiUser, $apiKey, $apiHost);

$search = isset($_GET['search']) ? $_GET['search'] : false;
$album  = isset($_GET['album'])  ? $_GET['album'] : false;
$out = array();

switch($_GET['rest']) {
  case 'list_media': $response = $client->listMedia($album, $search);
    foreach($response as $k => $item) {
      $out[$k] = $item->toArray();
      $out[$k]['thumbnailUrl'] = $item->getThumbnailUrl(150,150);
      $out[$k]['isImage'] = $item->isImage();
    }
    break;
  case 'list_albums': $response = $client->listAlbums(); break;
}

echo json_encode($out);
exit();
