<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mycaptcha {

    public $word = '';
    public $ci = ''; 
    public function __construct() {    
        $CI = & get_instance();
        $CI->load->helper('captcha');
        $this->ci = $CI; 
    }
    public function createWord()
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $word = '';
        for ($a = 0; $a <= 5; $a++) {
            $b = rand(0, strlen($chars) - 1);
            $word .= $chars[$b];
        }        
        $this->word = $word; 
        return $this;
    }
    public function deleteImage()
    {
        if(isset($this->ci->session->userdata['image'])){
            $lastImage = FCPATH . "httpdocs/captcha/" . $this->ci->session->userdata['image'];
            if(file_exists($lastImage)){
                unlink($lastImage);
            }    
        }
        return $this;
    }
    public function createCaptcha()
    {
        $cap = array(
            'word' => $this->word,
            'img_path' => './httpdocs/captcha/',
            'img_url' => base_url() . 'httpdocs/captcha/',
            'img_width' => '150',
            'img_height' => '30',
            'expiration' => '7200'
        );
                 
        $captchaOutput = create_captcha($cap); 
        $this->ci->session->set_userdata(array('word'=>$this->word, 'image' => $captchaOutput['time'].'.jpg'));
        return $captchaOutput['image']; 
    } 
}

?>