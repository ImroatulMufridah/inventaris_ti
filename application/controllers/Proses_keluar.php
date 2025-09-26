<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proses_keluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_keluar_model');
        $this->load->helper('url');
    }

    public function index()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $id = $this->input->post('barang_id');
            $jumlah = $this->input->post('jumlah');
            $tanggal = $this->input->post('tanggal');
            $this->Barang_keluar_model->proses_keluar($id, $jumlah, $tanggal);
            redirect('barang');
        } else {
            show_404();
        }
    }
}
