<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Get_barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
    }

    public function index()
    {
        $search = $this->input->get('q');
        $type = $this->input->get('type') ?: 'masuk';
        $result = $this->Barang_model->search_barang($search, $type);
        $data = [];
        foreach ($result as $row) {
            if ($type === 'keluar') {
                $text = $row['nama_barang'] . " (Stok: " . $row['jumlah'] . ")";
            } else {
                $text = $row['nama_barang'];
            }
            $data[] = [
                "id" => $row['id'],
                "text" => $text
            ];
        }
        header('Content-Type: application/json');
        echo json_encode(["results" => $data]);
    }
}
