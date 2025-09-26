<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_masuk_model extends CI_Model
{
    public function masukkan_barang($barang_id, $jumlah, $tanggal)
    {
        // Insert log barang masuk
        $this->db->insert('barang_masuk', [
            'barang_id' => $barang_id,
            'jumlah' => $jumlah,
            'tanggal' => $tanggal
        ]);
        // Update stok barang
        $this->db->set('jumlah', 'jumlah + ' . (int) $jumlah, false);
        $this->db->where('id', $barang_id);
        $this->db->update('barang');
        return true;
    }
}
