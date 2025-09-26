<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_masuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_masuk_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['success'] = false;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $barang_id = (int) $this->input->post('barang_id');
            $jumlah = (int) $this->input->post('jumlah');
            $tanggal = $this->input->post('tanggal');
            $result = $this->Barang_masuk_model->masukkan_barang($barang_id, $jumlah, $tanggal);
            if ($result === true) {
                $data['success'] = true;
            }
        }
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('barang_masuk/index', $data);
        $this->load->view('templates/footer');
    }
}
