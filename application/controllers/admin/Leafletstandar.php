<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leafletstandar extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->logged !== true) {
			redirect('admin/auth');
		}
		$this->load->model('HotspotModel', 'model');
		$this->load->model('Rute_model');
	}

	public function index()
	{
		$datacontent['url'] = 'admin/leafletstandar';
		$datacontent['title'] = 'Halaman Peta Utama';
		// $datacontent['datatable']=$this->model->get();
		$data['content'] = $this->load->view('admin/map/leafletstandar/mapView', $datacontent, TRUE);
		$data['js'] = $this->load->view('admin/map/leafletstandar/js/mapJs', $datacontent, TRUE);
		$data['title'] = $datacontent['title'];
		$this->load->view('admin/tes/primary', $data);
	}
}
