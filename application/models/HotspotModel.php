<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HotspotModel extends CI_Model
{
	function get()
	{
		$data = $this->db->select('*')
			->from('tb_stop a')
			->join('tb_jalur b', 'a.id_jalur=b.id_jalur', 'LEFT')
			// ->join('m_kategori_hotspot c','a.id_kategori_hotspot=c.id_kategori_hotspot','LEFT')
			->get();
		return $data;
	}
	public function insert($data = array())
	{
		$this->db->insert('tb_stop', $data);
		$info = '<div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-check"></i> Sukses!</h4> Data Sukses Ditambah </div>';
		$this->session->set_flashdata('info', $info);
	}

	public function update($data = array(), $where = array())
	{
		foreach ($where as $key => $value) {
			$this->db->where($key, $value);
		}
		$this->db->update('tb_stop', $data);
		$info = '<div class="alert alert-success alert-dismissible">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> Sukses!</h4> Data Sukses diubah </div>';
		$this->session->set_flashdata('info', $info);
	}

	function delete($where = array())
	{
		foreach ($where as $key => $value) {
			$this->db->where($key, $value);
		}
		$this->db->delete('tb_stop');
		$info = '<div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-check"></i> Sukses!</h4> Data Sukses dihapus </div>';
		$this->session->set_flashdata('info', $info);
	}
}
