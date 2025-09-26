<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Detail_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $id = $this->input->get('id');
        if (empty($id)) {
            show_error('ID Barang tidak ditemukan.');
        }
        $data['data_barang'] = $this->Detail_model->get_barang($id);
        if (!$data['data_barang']) {
            show_error('Data barang tidak ditemukan.');
        }
        $data['masuk'] = $this->Detail_model->get_barang_masuk($id);
        $data['keluar'] = $this->Detail_model->get_barang_keluar($id);
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('detail/index', $data);
        $this->load->view('templates/footer');
    }
}
