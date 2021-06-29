<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rute_model extends CI_Model
{
    public function get_jalur()
    {
        $data = $this->db->get('tb_jalur');
        return $data;
    }

    public function get_stop()
    {
        $data = $this->db->get('tb_stop');
        return $data;
    }

    public function insert($data = array())
    {
        $this->db->insert('tb_jalur', $data);
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
        $this->db->update('tb_jalur', $data);
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
        $this->db->delete('tb_jalur');
        $info = '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Sukses!</h4> Data Sukses dihapus </div>';
        $this->session->set_flashdata('info', $info);
    }
}
