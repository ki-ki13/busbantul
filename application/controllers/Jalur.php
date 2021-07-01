<?php
defined('BASEPATH') or exit('No direct script access allowed');
require './vendor/autoload.php';

use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\DropboxFile;
use Kunnu\Dropbox\Exceptions\DropboxClientException;


class Jalur extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        if ($this->session->logged !== true) {
            redirect('admin/auth');
        }
        $this->load->model('rute_model', 'model');
    }

    public function index()
    {
       
        $datacontent['title'] = 'Daftar Jalur';
        $datacontent['url'] = 'jalur';
        $datacontent['data_jalur'] = $this->model->get_jalur();
        $data['content'] = $this->load->view('admin/jalur/jalurview', $datacontent, TRUE);
        $data['title'] = $datacontent['title'];
        $this->load->view('admin/tes/primary', $data);
    }
 
    public function form($parameter = '', $id = '')
    {
        $datacontent['title'] = 'Form Jalur';
        $datacontent['url'] = 'jalur';
        $datacontent['parameter'] = $parameter;
        $datacontent['id'] = $id;
        $datacontent['data_jalur'] = $this->model->get_jalur();
        $data['content'] = $this->load->view('admin/jalur/formview', $datacontent, TRUE);
        $data['title'] = $datacontent['title'];
        $this->load->view('admin/tes/primary', $data);
    }
    public function simpan()
    {
		//Configure Dropbox Application
        $app = new DropboxApp("xh0dpdrsrs8cpox", "vcwlcd9ejra58o9", "qy0yCkeNO5EAAAAAAAAAAaI6kHjcAZu_3KcXl94ssPwM1cz-VP7w-ORgiBuWdK56");

        //Configure Dropbox service
        $dropbox = new Dropbox($app);

        if ($this->input->post('simpan')) {
            $data = [
                'kd_jalur' => $this->input->post('kd_jalur'),
                'jalur' => $this->input->post('jalur'),
                'warna' => $this->input->post('warna'),
            ];

            if ($_FILES['geojson']['name'] != '') {

                $file = $_FILES['geojson'];

                // File Path
                $fileName = $file['name'];
                $filePath = $file['tmp_name'];

                try {
                    // Create Dropbox File from Path
                    $dropboxFile = new DropboxFile($filePath);

                    // Upload the file to Dropbox
                    $uploadedFile = $dropbox->upload($dropboxFile, "/Apps/Busbantul/" . $fileName, ['autorename' => false]);
                    $data['geojson'] = $fileName;
                    // File Uploaded
                    echo $uploadedFile->getPathDisplay();
                } catch (DropboxClientException $e) {
                    //$e->getMessage;
                    $error = "Masukkan file dengan nama yang berbeda dari sebelumnya";
                    $info = '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Error!</h4> ' . $error . ' </div>';
                    $this->session->set_flashdata('info', $info);
                    redirect('jalur');
                    exit();
                }
                // $upload = upload('geojson', 'geojson', 'geojson');
                // if ($upload['info'] == true) {
                //     $data['geojson'] = $upload['upload_data']['file_name'];
                // } elseif ($upload['info'] == false) {
                //     $info = '<div class="alert alert-danger alert-dismissible">
                //     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                //     <h4><i class="icon fa fa-ban"></i> Error!</h4> ' . $upload['message'] . ' </div>';
                //     $this->session->set_flashdata('info', $info);
                //     // var_dump($upload);
                //     // die();
                //     redirect('jalur');
                //     exit();
                // }
                $link= getLink("/Apps/Busbantul/". $data['geojson']);
                $data['linkgeojson'] = $link['url'];
            }
            // if ($_FILES['marker']['name'] != '') {

            //     $file2 = $_FILES['marker'];

            //     // File Path
            //     $fileName2 = $file2['name'];
            //     $filePath2 = $file2['tmp_name'];

            //     try {
            //         // Create Dropbox File from Path
            //         $dropboxFile2 = new DropboxFile($filePath2);

            //         // Upload the file to Dropbox
            //         $uploadedFile2 = $dropbox->upload($dropboxFile2, "/Apps/Busbantul/" . $fileName2, ['autorename' => false]);

            //         // File Uploaded
            //         $data['marker'] = $fileName2;
            //         echo $uploadedFile2->getPathDisplay();
            //     } catch (DropboxClientException $e) {
            //         $e->getMessage();
            //         $info = '<div class="alert alert-danger alert-dismissible">
            //         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            //         <h4><i class="icon fa fa-ban"></i> Error!</h4> ' . $e . ' </div>';
            //         $this->session->set_flashdata('info', $info);
            //         redirect('jalur');
            //         exit();
            //     }
            //     // $upload = upload('marker', 'marker', 'image');
            //     // if ($upload['info'] == true) {
            //     //     $data['marker'] = $upload['upload_data']['file_name'];
            //     // } elseif ($upload['info'] == false) {
            //     //     $info = '<div class="alert alert-danger alert-dismissible">
            //     //     	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            //     //     	<h4><i class="icon fa fa-ban"></i> Error!</h4> ' . $upload['message'] . ' </div>';
            //     //     $this->session->set_flashdata('info', $info);
            //     //     // var_dump($upload);
            //     //     // die();
            //     //     redirect('jalur');
            //     //     exit();
            //     $link2= getLink("/Apps/Busbantul/". $data['marker']);
            //     $data['linkmarker'] = $link2['url'];
            // }
           
            
            
            
            if ($_POST['parameter'] == "tambah") {
                $this->model->insert($data);
            } else {
                $this->model->update($data, ['id_jalur' => $this->input->post('id_jalur')]);
            }
        }
        
        redirect('jalur');
    }

    public function linkGeojson($id=''){
        $this->db->where('id_jalur', $id);
        $datum = $this->model->get_jalur()->row();
        echo "<a href='$datum->linkgeojson'>Link geojson, download it anyway</a>";
    }
    // public function linkMarker($id=''){
    //     $datum = $this->model->get_jalur();
    //     $path = "/Apps/Busbantul/" . $datum->marker;
    //     $dataLink = getLink($id,$path);
    // }

    public function hapus($id = '')
    {
        //Configure Dropbox Application
        $app = new DropboxApp("xh0dpdrsrs8cpox", "vcwlcd9ejra58o9", "qy0yCkeNO5EAAAAAAAAAAaI6kHjcAZu_3KcXl94ssPwM1cz-VP7w-ORgiBuWdK56");

        //Configure Dropbox service
        $dropbox = new Dropbox($app);
        // hapus file di dalam folder
        $this->db->where('id_jalur', $id);
        $get = $this->model->get_jalur()->row();
        $geojson = $get->geojson;
        $marker = $get->marker;
        $deletedFolder = $dropbox->delete("/Apps/Busbantul/" . $geojson);
        $deletedFolder2 = $dropbox->delete("/Apps/Busbantul/" . $marker);
        $deletedFolder->getName();
        $deletedFolder2->getName();
        // end hapus file di dalam folder
        $this->model->delete(["id_jalur" => $id]);
        redirect('jalur');
    }
}
