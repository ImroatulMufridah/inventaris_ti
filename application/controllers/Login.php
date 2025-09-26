<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        // $this->load->library('input'); // Removed, not needed
    }

    public function index()
    {
        $data['error'] = '';
        if ($this->input->post('login')) {
            $username = trim($this->input->post('username'));
            $password = trim($this->input->post('password'));
            $user = $this->User_model->get_user_by_username($username);
            if ($user && $password === $user['password']) {
                $this->session->set_userdata([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role']
                ]);
                redirect('barang');
            } else {
                $data['error'] = 'Username atau Password salah!';
            }
        }
        $this->load->view('login/index', $data);
    }
}
