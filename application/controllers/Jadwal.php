<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('JadwalModel', 'model');
		$this->load->model('Rute_model');
		// $this->load->model('KategorihotspotModel');
	}

	public function index()
	{
		// $datacontent['kota'] = $this->model->getkota();
		$datacontent['url'] = 'jadwal';
		$datacontent['title'] = 'Daftar Jadwal Bus';
		$datacontent['datastop'] = $this->model->get_jadwal();
		$data['content'] = $this->load->view('admin/jadwal/jadwalView', $datacontent, TRUE);
		$data['js'] = $this->load->view('admin/jadwal/js/tableJs', $datacontent, TRUE);
		$data['title'] = $datacontent['title'];
		$this->load->view('admin/tes/primary', $data);
	}
	public function form($parameter = '', $id = '')
	{
		$datacontent['url'] = 'jadwal';
		$datacontent['parameter'] = $parameter;
		$datacontent['id'] = $id;
		$datacontent['title'] = 'Form Jadwal';
		$data['content'] = $this->load->view('admin/jadwal/formView', $datacontent, TRUE);
		$data['js'] = $this->load->view('admin/jadwal/js/formJs', $datacontent, TRUE);
		$data['title'] = $datacontent['title'];
		$this->load->view('admin/tes/primary', $data);
	}
	public function simpan()
	{
		if ($this->input->post()) {
			$data = [
				'id_jalur' => $this->input->post('id_jalur'),
				'id_stop' => $this->input->post('id_stop'),
				'durasi' => $this->input->post('durasi'),
				'jadwal1' => $this->input->post('jadwal1'),
				'jadwal2' => $this->input->post('jadwal2'),
				'jadwal3' => $this->input->post('jadwal3'),
			];

			if ($_POST['parameter'] == "tambah") {
				$this->model->insert($data);
			} else {
				$this->model->update($data, ['id_jadwal' => $this->input->post('id_jadwal')]);
			}
		}
		redirect('jadwal');
	}
	public function hapus($id = '')
	{
		// hapus file di dalam folder
		$this->db->where('id_jadwal', $id);
		$this->model->delete(["id_jadwal" => $id]);
		redirect('jadwal');
	}

	// public function urut()
	// {
	// 	$datacontent['kota'] = $this->model->getkota();
	// 	if ($this->input->post('submit2')) {
	// 		$datacontent['pilihan'] = $this->input->post('jalur');
	// 		$datacontent['datastop'] = $this->model->get_kota_mahasiswa();
	// 	} else {

	// 		$datacontent['datastop'] = $this->model->get();
	// 	}

	// 	$datacontent['title'] = 'Daftar Tempat Pemberhentian Bus';
	// 	$datacontent['url'] = 'stop/urut';

	// 	$data['content'] = $this->load->view('admin/stop/short', $datacontent, TRUE);
	// 	$data['js'] = $this->load->view('admin/stop/js/tableJs', $datacontent, TRUE);
	// 	$data['title'] = $datacontent['title'];
	// 	$this->load->view('admin/tes/primary', $data);
	// }
}
