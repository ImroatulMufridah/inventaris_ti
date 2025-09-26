<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tambah_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
    }

    public function index()
    {
        if ($this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'Akses ditolak! Hanya Admin yang bisa.');
            redirect('user');
        }
        if ($this->input->post('simpan')) {
            $username = $this->input->post('username');
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $role = $this->input->post('role');
            $this->User_model->tambah_user($username, $password, $role);
            redirect('user');
        }
        $this->load->view('tambah_user/index');
    }
}
