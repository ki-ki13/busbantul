<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stop extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->logged !== true) {
			redirect('admin/auth');
		}
		$this->load->model('HotspotModel', 'model');
		$this->load->model('Rute_model');
		// $this->load->model('KategorihotspotModel');
	}

	public function index()
	{
		// $datacontent['kota'] = $this->model->getkota();
		$datacontent['url'] = 'stop';
		$datacontent['title'] = 'Daftar Tempat Pemberhentian Bus';
		$datacontent['datastop'] = $this->model->get();
		$data['content'] = $this->load->view('admin/stop/tableView', $datacontent, TRUE);
		$data['js'] = $this->load->view('admin/stop/js/tableJs', $datacontent, TRUE);
		$data['title'] = $datacontent['title'];
		$this->load->view('admin/tes/primary', $data);
	}
	public function form($parameter = '', $id = '')
	{
		$datacontent['url'] = 'stop';
		$datacontent['parameter'] = $parameter;
		$datacontent['id'] = $id;
		$datacontent['title'] = 'Form Pemberhentian';
		$data['content'] = $this->load->view('admin/stop/formView', $datacontent, TRUE);
		$data['js'] = $this->load->view('admin/stop/js/formJs', $datacontent, TRUE);
		$data['title'] = $datacontent['title'];
		$this->load->view('admin/tes/primary', $data);
	}
	public function simpan()
	{
		if ($this->input->post()) {
			$data = [
				'id_jalur' => $this->input->post('id_jalur'),
				'stop' => $this->input->post('stop'),
				'latitude' => $this->input->post('latitude'),
				'longitude' => $this->input->post('longitude'),
			];

			if ($_POST['parameter'] == "tambah") {
				$this->model->insert($data);
			} else {
				$this->model->update($data, ['id_stop' => $this->input->post('id_stop')]);
			}
		}
		redirect('stop');
	}
	// public function hapus($id = '')
	// {
	// 	// hapus file di dalam folder
	// 	$this->db->where('id_stop', $id);
	// 	$get = $this->model->get()->row();
	// 	$marker = $get->marker;
	// 	unlink('assets/unggah/marker/' . $marker);
	// 	// end hapus file di dalam folder
	// 	$this->model->delete(["id_stop" => $id]);
	// 	redirect('stop');
	// }

	public function datatable()
	{
		header('Content-Type: application/json');
		$url = 'stop';
		$kolom = ['id_stop', 'jalur', 'stop', 'latitude', 'longitude', 'marker'];

		if ($this->input->get('sSearch')) {
			$this->db->group_start();
			for ($i = 0; $i < count($kolom); $i++) {
				$this->db->or_like($kolom[$i], $this->input->get('sSearch', TRUE));
			}
			$this->db->group_end();
		}
		//order
		if ($this->input->get('iSortCol_0')) {
			for ($i = 0; $i < intval($this->input->get('iSortingCols', TRUE)); $i++) {
				if ($this->input->get('bSortable_' . intval($_GET['iSortCol_' . $i]), TRUE) == "true") {
					$this->db->order_by($kolom[intval($this->input->get('iSortCol_' . $i, TRUE))], $this->input->get('sSortDir_' . $i, TRUE));
				}
			}
		}

		if ($this->input->get('iDisplayLength', TRUE) != "-1") {
			$this->db->limit($this->input->get('iDisplayLength', TRUE), $this->input->get('iDisplayStart'));
		}

		$dataTable = $this->model->get();
		$iTotalDisplayRecords = $this->model->get()->num_rows();
		$iTotalRecords = $dataTable->num_rows();
		$output = [
			"sEcho" => intval($this->input->get('sEcho')),
			"iTotalRecords" => $iTotalRecords,
			"iTotalDisplayRecords" => $iTotalDisplayRecords,
			"aaData" => array()
		];
		$no = 1;
		foreach ($dataTable->result() as $row) {
			$r = null;
			$r[] = $no++;
			$r[] = $row->jalur;
			$r[] = $row->stop;
			$r[] = $row->latitude;
			$r[] = $row->longitude;
			$r[] = '<i class="fa fa-map-marker-alt" style="color : ' . $row->warna . '; font-size: 30px "></i>';
			//$r[] = $row->marker == '' ? '-' : '<img src="' . ('assets/unggah/marker/' . $row->marker) . '" width="40px">';
			$r[] = '<a href="' . site_url($url . '/form/ubah/' . $row->id_stop) . '" class="btn btn-info"><i class="fa fa-edit"></i></a>;
								<a href="' . site_url($url . '/hapus/' . $row->id_stop) . '" class="btn btn-danger" onclick="return confirm(\'Hapus data?\')"><i class="fa fa-trash"></i></a>';
			$output['aaData'][] = $r;
		}
		echo json_encode($output, JSON_PRETTY_PRINT);
	}

	/* 					<tbody>
					<?php
					$no = 1;
					foreach ($datastop->result() as $row) {
					?>
						<tr>
							<td><?= $no ?></td>
							<td><?= $row->jalur ?></td>
							<td><?= $row->stop ?></td>
							<td><?= $row->latitude ?></td>
							<td><?= $row->longitude ?></td>
							<td class="text-center"><?= ($row->marker == '' ? '-' : '<img src="' . ('assets/unggah/marker/' . $row->marker) . '" width="40px">') ?></td>
							<td>
								<a href="<?= site_url($url . '/form/ubah/' . $row->id_stop) ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
								<a href="<?= site_url($url . '/hapus/' . $row->id_stop) ?>" class="btn btn-danger" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					<?php
						$no++;
					}

					?>
				</tbody> **/
}
