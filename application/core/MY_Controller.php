<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    protected $data = [];

    public function __construct() {
        parent::__construct();
        
        // Get the current controller name for active menu highlighting
        $this->data['link'] = $this->router->fetch_class();
    }

    protected function render($view, $local_data = []) {
        $data = array_merge($this->data, $local_data);
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view($view, $data);
        $this->load->view('templates/footer', $data);
    }
}