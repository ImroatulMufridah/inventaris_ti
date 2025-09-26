<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    public function get_all_barang()
    {
        $this->db->select('b.id, b.nama_barang, b.jumlah AS stok, b.foto, 
            IFNULL((SELECT SUM(m.jumlah) FROM barang_masuk m WHERE m.barang_id = b.id), 0) AS total_masuk,
            IFNULL((SELECT SUM(k.jumlah) FROM barang_keluar k WHERE k.barang_id = b.id), 0) AS total_keluar');
        $this->db->from('barang b');
        $this->db->order_by('b.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function search_barang($search = '', $type = 'masuk')
    {
        $this->db->select('id, nama_barang, jumlah');
        if (!empty($search)) {
            $this->db->like('nama_barang', $search);
        }
        $this->db->order_by('nama_barang', 'ASC');
        $this->db->limit(20);
        return $this->db->get('barang')->result_array();
    }

    public function hapus_barang($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('barang');
    }

    public function get_total_barang()
    {
        $this->db->select_sum('jumlah');
        $query = $this->db->get('barang');
        $row = $query->row_array();
        return isset($row['jumlah']) ? $row['jumlah'] : 0;
    }

    public function tambah_barang($nama, $jumlah, $foto = '')
    {
        $this->db->insert('barang', [
            'nama_barang' => $nama,
            'jumlah' => $jumlah,
            'foto' => $foto
        ]);
    }
}
