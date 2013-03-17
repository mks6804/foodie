<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class contact extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('email');
    }

    public function index() {
        $data['title'] = 'Contact';
        
        $this->form_validation->set_error_delimiters('<div class="alert-box alert">', '</div>');
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[50]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[50]');
        $this->form_validation->set_rules('message', 'Message', 'required|max_length[255]');
        $this->form_validation->set_rules('captcha', 'Captcha', 'required|validate_captcha'); //activate this rule        
        $this->load->library('mycaptcha');
        
        if ($this->form_validation->run() == FALSE) {          
            $data['captcha'] = $this->mycaptcha->deleteImage()
                    ->createWord()
                    ->createCaptcha();
            $this->load->view('public/contact', $data);
            
        } else {  
            $this->mycaptcha->deleteImage();
            $this->session->set_flashdata(array('message' => 'Your message was sent successfully', 'type' => 'success'));
              
            $fromEmail = $this->input->post('email');
            $name = $this->input->post('name');
            $message = $this->input->post('message');

           
            $this->email->from($fromEmail, $name);
            $this->email->to('');

            $this->email->subject('A new message website');
            $this->email->message($message);
         //   $this->email->send();
            
            redirect('/');
          
        }
    }
    
    
    

}

