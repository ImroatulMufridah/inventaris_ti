<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_keluar_model extends CI_Model
{
    public function keluarkan_barang($barang_id, $jumlah, $tanggal)
    {
        $this->db->where('id', $barang_id);
        $barang = $this->db->get('barang')->row_array();
        $stok = isset($barang['jumlah']) ? (int) $barang['jumlah'] : 0;
        if ($stok < $jumlah) {
            return 'stok_kurang';
        }
        // Insert log barang keluar
        $this->db->insert('barang_keluar', [
            'barang_id' => $barang_id,
            'jumlah' => $jumlah,
            'tanggal' => $tanggal
        ]);
        // Update stok barang
        $this->db->set('jumlah', 'jumlah - ' . (int) $jumlah, false);
        $this->db->where('id', $barang_id);
        $this->db->update('barang');
        return true;
    }
}
