<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class about extends CI_Controller 
{
    public function index() {
        $data['title'] = 'about us';
        $this->load->view('public/about', $data);
    }

}
