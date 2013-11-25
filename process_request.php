<?php

// Initializing API
use Keyteq\Keymedia\KeymediaClient;

$options = get_option('keymedia_settings');
$apiUser = $options['keymedia_username'];
$apiKey = $options['keymedia_token'];
$apiHost = $options['keymedia_host'];

$search = isset($_GET['search']) ? $_GET['search'] : false;
$album = isset($_GET['album']) ? $_GET['album'] : false;
$out = array();

switch ($_GET['rest']) {
    case 'list_media':
        $client = new KeymediaClient($apiUser, $apiHost, $apiKey);
        $response = $client->listMedia($album, $search);
        foreach ($response as $k => $item) {
            $out[$k] = $item->toArray();
            $out[$k]['thumbnailUrl'] = $item->getThumbnailUrl(150, 150);
            $out[$k]['microthumbnailUrl'] = $item->getThumbnailUrl(40, 40);
            $out[$k]['isImage'] = $item->isImage();
        }
        break;
    case 'list_albums':
        $client = new KeymediaClient($apiUser, $apiHost, $apiKey);
        $response = $client->listAlbums();
        foreach ($response as $item) {
            $out[] = $item->toArray();
        }
        break;
    case 'upload':
        $client = new KeymediaClient($apiUser, $apiHost, $apiKey);
        $client->postMedia(
                $_FILES['file']['tmp_name'], $_FILES['file']['name']
        );
        break;
    case 'check_connection':
        $client = new KeymediaClient($_GET['username'], $_GET['host'], $_GET['token']);
        $out = $client->isConnected();
        break;
    case 'get_token':
        $client = new KeymediaClient($_GET['username'], $_GET['host']);
        $out = $client->getToken($_GET['password']);
        break;
}

echo json_encode($out);
exit();
