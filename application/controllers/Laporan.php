<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['result'] = $this->Barang_model->get_all_barang();
        $data['total'] = $this->Barang_model->get_total_barang();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/index', $data);
        $this->load->view('templates/footer');
    }
}
