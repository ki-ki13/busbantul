<?php
require './vendor/autoload.php';

use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\DropboxFile;
use Kunnu\Dropbox\Exceptions\DropboxClientException;

function content_open()
{
    return '<div class="container-fluid">

    <div class="container mt-5">';
}

function content_close()
{
    return '
    </div>
    </div>';
} 
function upload($name = 'file', $folder = 'geojson', $types = "image")
{

    if ($types == 'image') {
        $allowed_types = 'gif|jpg|png';
        // $config['max_width']    = 1024;
        // $config['max_height']   = 768;
    } elseif ($types == 'geojson') {
        $allowed_types = 'geojson';
    } elseif ($types == 'csv') {
        $allowed_types = 'csv';
    }
    $CI = &get_instance();
    $config['upload_path']          = './assets/unggah/' . $folder . '/';
    $config['allowed_types']        = $allowed_types;
    $config['max_size']             = 1000;
    $CI->load->library('upload', $config);
    if (!$CI->upload->do_upload($name)) {
        $response['info'] = false;
        $response['message'] = $CI->upload->display_errors();
    } else {
        $response['info'] = true;
        $response['message'] = "Sukses di unggah";
        $response['upload_data'] = $CI->upload->data();
    }
    return $response;
}

function getLink($path=''){
    $app = new DropboxApp("xh0dpdrsrs8cpox", "vcwlcd9ejra58o9", "qy0yCkeNO5EAAAAAAAAAAaI6kHjcAZu_3KcXl94ssPwM1cz-VP7w-ORgiBuWdK56");
    $dropbox = new Dropbox($app);
    $pathToFile = $path;
    //echo $pathToFile;

    $response = $dropbox->postToAPI("/sharing/create_shared_link_with_settings", [
        "path" => $pathToFile
    ]);
    ob_start();
    $data = $response->getDecodedBody();
    $ket = "if u want to get the geojson file, search for the 'url' in json properties, 
    if there's an error due to u clicked twice on this link than the shared link has been created bitch";
    //$data = json_decode($data);
    return $data;
 }

 function haveLink(){
    $app = new DropboxApp("xh0dpdrsrs8cpox", "vcwlcd9ejra58o9", "qy0yCkeNO5EAAAAAAAAAAaI6kHjcAZu_3KcXl94ssPwM1cz-VP7w-ORgiBuWdK56");
    $dropbox = new Dropbox($app);
    $response2 = $dropbox->postToAPI("/sharing/get_shared_link_file", [
        "url" => $data
    ]);
    $data2 = $response2->getDecodedBody();
 }
