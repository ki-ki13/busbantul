<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jalur extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        parent::__construct();
        $this->load->model('rute_model', 'model');
    }

    public function index()
    {
        $datacontent['title'] = 'Daftar Jalur';
        $datacontent['url'] = 'jalur';
        $datacontent['data_jalur'] = $this->model->get_jalur();
        $datacontent['data_stop'] = $this->model->get_stop();
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
        $datacontent['data_stop'] = $this->model->get_stop();
        $data['content'] = $this->load->view('admin/jalur/formview', $datacontent, TRUE);
        $data['title'] = $datacontent['title'];
        $this->load->view('admin/tes/primary', $data);
    }
    public function simpan()
    {
        if ($this->input->post('simpan')) {
            $data = [
                'jalur' => $this->input->post('jalur'),
                'warna' => $this->input->post('warna'),
            ];

            if ($_FILES['geojson']['name'] != '') {
                $upload = upload('geojson', 'geojson');
                if ($upload['info'] == true) {
                    $data['geojson'] = $upload['upload_data']['file_name'];
                } elseif ($upload['info'] == false) {
                    // $info = '<div class="alert alert-danger alert-dismissible">
                    // 	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    // 	<h4><i class="icon fa fa-ban"></i> Error!</h4> ' . $upload['message'] . ' </div>';
                    // $this->session->set_flashdata('info', $info);
                    redirect('jalur');
                    exit();
                }
            }

            if ($_POST['parameter'] == "tambah") {
                $this->model->insert($data);
            } else {
                $this->model->update($data, ['id_jalur' => $this->input->post('id_jalur')]);
            }
        }
        redirect('jalur');
    }

    public function hapus($id = '')
    {
        // hapus file di dalam folder
        $this->db->where('id_jalur', $id);
        $get = $this->model->get_jalur()->row();
        $geojson = $get->geojson;
        unlink('assets/unggah/geojson/' . $geojson);
        // end hapus file di dalam folder
        $this->model->delete(["id_jalur" => $id]);
        redirect('jalur');
    }
}
