<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->logged !== true) {
			redirect('admin/auth');
		}
		$this->load->model('JadwalModel', 'model');
		$this->load->model('Rute_model');
		// $this->load->model('KategorihotspotModel');
	}

	public function index()
	{
		// $datacontent['kota'] = $this->model->getkota();
		$datacontent['url'] = 'admin/jadwal';
		$datacontent['title'] = 'Daftar Jadwal Bus';
		$datacontent['datastop'] = $this->model->get_jadwal();
		$data['content'] = $this->load->view('admin/jadwal/jadwalView', $datacontent, TRUE);
		$data['js'] = $this->load->view('admin/jadwal/js/tableJs', $datacontent, TRUE);
		$data['title'] = $datacontent['title'];
		$this->load->view('admin/tes/primary', $data);
	}
	public function form($parameter = '', $id = '')
	{
		$datacontent['url'] = 'admin/jadwal';
		$datacontent['parameter'] = $parameter;
		$datacontent['id'] = $id;
		$datacontent['title'] = 'Form Jadwal';
		$data['content'] = $this->load->view('admin/jadwal/formView', $datacontent, TRUE);
		// $data['js'] = $this->load->view('admin/jadwal/js/formJs', $datacontent, TRUE);
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
		redirect('admin/jadwal');
	}
	public function hapus($id = '')
	{
		// hapus file di dalam folder
		$this->db->where('id_jadwal', $id);
		$this->model->delete(["id_jadwal" => $id]);
		redirect('admin/jadwal');
	}

	public function datatable()
	{
		header('Content-Type: application/json');
		$url = 'admin/jadwal';
		$kolom = ['id_jadwal', 'kd_jalur', 'stop', 'durasi', 'jadwal1', 'jadwal2', 'jadwal3'];

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

		$dataTable = $this->model->get_jadwal();
		$iTotalDisplayRecords = $this->model->get_jadwal()->num_rows();
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
			$r[] = $row->kd_jalur;
			$r[] = $row->jalur;
			$r[] = $row->stop;
			$r[] = $row->durasi;
			$r[] = $row->jadwal1;
			$r[] = $row->jadwal2;
			$r[] = $row->jadwal3;
			$r[] = '<a href="' . site_url($url . '/form/ubah/' . $row->id_jadwal) . '" class="btn btn-info"><i class="fa fa-edit"></i></a>;
								<a href="' . site_url($url . '/hapus/' . $row->id_jadwal) . '" class="btn btn-danger" onclick="return confirm(\'Hapus data?\')"><i class="fa fa-trash"></i></a>';
			$output['aaData'][] = $r;
		}
		echo json_encode($output, JSON_PRETTY_PRINT);
	}

	/**	<tbody>
						<?php
						$no = 1;
						foreach ($datastop->result() as $row) {
						?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $row->kd_jalur ?></td>
								<td><?= $row->jalur ?></td>
								<td><?= $row->stop ?></td>
								<td><?= $row->durasi ?></td>
								<td><?= $row->jadwal1 ?></td>
								<td><?= $row->jadwal2 ?></td>
								<td><?= $row->jadwal3 ?></td>
								<td>
									<a href="<?= site_url($url . '/form/ubah/' . $row->id_stop) ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
									<a href="<?= site_url($url . '/hapus/' . $row->id_stop) ?>" class="btn btn-danger" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php
							$no++;
						}

						?>
					</tbody>**/
}
