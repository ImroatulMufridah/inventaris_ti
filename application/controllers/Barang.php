<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
        $this->load->library('session');
    }

    public function index()
    {
        $role = $this->session->userdata('role');
        $data['role'] = $role;
        $data['barang'] = $this->Barang_model->get_all_barang();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('barang/index', $data);
        $this->load->view('templates/footer');
    }
}
