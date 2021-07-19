<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $datacontent['title'] = 'Login Form';
        $this->load->view('admin/auth/authview', $datacontent);
    }

    public function check()
    {
        if ($this->input->post()) {
            $nm_admin = $this->input->post('nm_admin');
            $password = $this->input->post('password');
            $this->db->where("nm_admin", $nm_admin);
            $data = $this->db->get("adminname");
            if ($data->num_rows() > 0) {
                // jika username ada
                $row = $data->row();
                $hash = $row->password;
                if (password_verify($password, $hash)) {
                    $this->session->set_userdata("logged", true);
                    $this->session->set_userdata("nm_admin", $row->nm_admin);
                    $this->session->set_userdata("id_admin", $row->id_admin);
                    $this->session->set_userdata("level", $row->level);
                    $this->session->set_flashdata("info", '<div class="alert alert-success alert-dismissible">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                    <h4><i class="icon fa fa-check"></i> Sukses!</h4> Selamat Datang <b>' . $row->nm_admin . '</b> di Halaman Utama Aplikasi
		                  </div>');
                    redirect("beranda");
                } else {
                    $this->session->set_userdata("logged", false);
                    $this->session->set_flashdata("info", '<div class="alert alert-danger alert-dismissible">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-ban"></i> Error!</h4> Nama admin atau Kata Sandi Salah
		              </div>');
                    redirect("admin/auth");
                }
            } else {
                $this->session->set_userdata("logged", false);
                $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Error!</h4> Nama admin atau Kata Sandi Salah
		            </div>');
                redirect("admin/auth");
            }
        } else {
            redirect("admin/auth");
        }
    }
    public function out()
    {
        $this->session->sess_destroy();
        redirect("admin/auth");
    }

    public function pendaftaran()
    {
        $datacontent['title'] = 'Login Form';
        $this->load->view('admin/auth/daftar', $datacontent);
    }

    public function registration()
    {

        $this->form_validation->set_rules('nm_admin', 'Nm_admin', 'required|trim');
        $this->form_validation->set_rules('level', 'level', 'required');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'unmathches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            redirect('pendaftaran');
        } else {
            $data = [
                'nm_admin' => $this->input->post('nm_admin'),
                'level' => $this->input->post('level'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),

            ];
            $this->db->insert('adminname', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation !!! <br> Your Account has been created</div>');
            redirect('admin/auth');
        }
    }
}
