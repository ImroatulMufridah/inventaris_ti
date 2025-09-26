<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Edit extends CI_Controller
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
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        if ($this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'Hanya Admin yang bisa mengakses!');
            redirect('barang');
        }
        $id = (int) $this->input->get('id');
        $data['data'] = $this->Barang_model->get_barang($id);
        $data['update_success'] = false;
        $data['foto_error'] = false;
        if ($this->input->post('update')) {
            $nama = $this->input->post('nama_barang');
            $jumlah = (int) $this->input->post('jumlah');
            $foto_sql = '';
            $filename = '';
            if (!empty($_FILES['foto']['name'])) {
                $config['upload_path'] = FCPATH . 'uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = time() . '_' . $_FILES['foto']['name'];
                $this->upload->initialize($config);
                if ($this->upload->do_upload('foto')) {
                    $filename = $this->upload->data('file_name');
                    // Hapus foto lama
                    if ($data['data']['foto'] && file_exists($config['upload_path'] . $data['data']['foto'])) {
                        unlink($config['upload_path'] . $data['data']['foto']);
                    }
                } else {
                    $data['foto_error'] = true;
                }
            }
            $update = $this->Barang_model->update_barang($id, $nama, $jumlah, $filename);
            $data['update_success'] = $update && !$data['foto_error'];
            $data['data'] = $this->Barang_model->get_barang($id);
        }
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('edit/index', $data);
        $this->load->view('templates/footer');
    }
}
