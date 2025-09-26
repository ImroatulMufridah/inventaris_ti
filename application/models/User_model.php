<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function hapus_user($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('user');
    }

    public function get_all_users()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('user')->result_array();
    }

    public function get_user_by_username($username)
    {
        return $this->db->get_where('user', ['username' => $username])->row_array();
    }
}
