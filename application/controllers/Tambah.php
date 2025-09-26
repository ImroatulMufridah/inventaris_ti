<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tambah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
        $this->load->library(['session', 'upload']);
        $this->load->helper(['url', 'form']);
    }

    public function index()
    {
        if ($this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'Akses ditolak! Hanya admin yang bisa menambah barang.');
            redirect('barang');
        }
        if ($this->input->post('simpan')) {
            $nama = $this->input->post('nama_barang');
            $jumlah = $this->input->post('jumlah');
            $foto = '';
            if (!empty($_FILES['foto']['name'])) {
                $config['upload_path'] = FCPATH . 'uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = time() . '_' . $_FILES['foto']['name'];
                $this->upload->initialize($config);
                if ($this->upload->do_upload('foto')) {
                    $foto = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', 'Gagal upload foto, cek permission folder uploads/');
                    redirect('tambah');
                }
            }
            $this->Barang_model->tambah_barang($nama, $jumlah, $foto);
            redirect('barang');
        }
        $this->load->view('tambah/index');
    }
}
