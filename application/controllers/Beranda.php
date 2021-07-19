<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
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
        $datacontent['title'] = 'Rute Bus Trans Bantul';
        $datacontent['data_jalur'] = $this->model->get_jalur();
        $data['content'] = $this->load->view('admin/berandaview', $datacontent, TRUE);
        $data['title'] = 'Admin Page Trans Bantul';
        $this->load->view('admin/tes/primary', $data);
    } 
}
