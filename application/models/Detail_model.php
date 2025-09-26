<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_model extends CI_Model
{
    public function get_barang($id)
    {
        return $this->db->get_where('barang', ['id' => $id])->row_array();
    }
    public function get_barang_masuk($id)
    {
        $this->db->select('tanggal, jumlah');
        $this->db->from('barang_masuk');
        $this->db->where('barang_id', $id);
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get()->result_array();
    }
    public function get_barang_keluar($id)
    {
        $this->db->select('tanggal, jumlah');
        $this->db->from('barang_keluar');
        $this->db->where('barang_id', $id);
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get()->result_array();
    }
}
