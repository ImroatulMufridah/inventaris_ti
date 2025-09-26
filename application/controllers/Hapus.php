<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hapus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        $data = [];
        if (!$this->session->userdata('user_id')) {
            $data['error'] = 'Silakan login terlebih dahulu!';
            $data['redirect'] = site_url('login');
        } elseif ($this->session->userdata('role') !== 'admin') {
            $data['error'] = 'Hanya Admin yang bisa menghapus!';
            $data['redirect'] = site_url('barang');
        } else {
            $id = $this->input->get('id');
            if (empty($id) || !is_numeric($id)) {
                $data['error'] = 'ID tidak valid!';
                $data['redirect'] = site_url('barang');
            } else {
                $hapus = $this->Barang_model->hapus_barang($id);
                if ($hapus) {
                    $data['success'] = 'Data barang berhasil dihapus!';
                } else {
                    $data['error'] = 'Data barang gagal dihapus!';
                }
                $data['redirect'] = site_url('barang');
            }
        }
        $this->load->view('hapus/index', $data);
    }
}
