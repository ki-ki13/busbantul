<?php

function upload1($name = 'file', $types = "images")
{
    if ($types == 'images') {
        $allowed_types = 'gif|jpg|png';
        // $config['max_width']    = 1024;
        // $config['max_height']   = 768;
    } elseif ($types == 'geojson') {
        $allowed_types = 'geojson';
    }
    $CI = &get_instance();
    $config['upload_path']          = './assets/unggah/geojson/';
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
