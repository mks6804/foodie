<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

	public function index()
	{
		$data['title']= 'Welcome to Foodie';		
		$this->load->view('public/home', $data);
	}	 
}