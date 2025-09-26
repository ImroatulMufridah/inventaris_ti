<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
}
