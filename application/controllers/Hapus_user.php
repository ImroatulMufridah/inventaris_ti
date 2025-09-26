<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hapus_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $data = [];
        $id = $this->input->get('id');
        if (empty($id) || !is_numeric($id)) {
            $data['error'] = 'ID user tidak valid!';
        } else {
            $hapus = $this->User_model->hapus_user($id);
            if ($hapus) {
                $data['success'] = 'User berhasil dihapus!';
            } else {
                $data['error'] = 'User gagal dihapus!';
            }
        }
        $this->load->view('hapus_user/index', $data);
    }
}
