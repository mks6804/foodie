<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    public function is_decimal($value) 
    {
        $CI = & get_instance();
        $regx = '/^[-+]?[0-9]*\.?[0-9]*$/';
        if (preg_match($regx, $value)) {
            return true;
        } else {
            $CI->form_validation->set_message('is_decimal', 'Must contain a valid Price');
            return false;
        }
    }

    public function valid_phone($value) 
    {
        $CI = & get_instance();
        if ($value == '') {
            return TRUE;
        } else {
            if (preg_match('/^\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}$/', $value)) {
                return preg_replace('/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/', '($1) $2-$3', $value);
            } else {
                $CI->form_validation->set_message('valid_phone', 'The %s field must contain a valid phone number');
                return FALSE;
            }
        }
    }

    public function alpha_dash_space($str_in) 
    {
        $CI = & get_instance();
        if (!preg_match("/^([-a-z0-9_ ])+$/i", $str_in)) {
            $CI->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha-numeric characters, spaces, underscores, and dashes.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function validate_captcha($word)
    {
         $CI = & get_instance(); 
         if(empty($word) || $word != $CI->session->userdata['word']){
            $CI->form_validation->set_message('validate_captcha', 'The letters you entered do not match the image.');
            return FALSE; 
         }else{
             return TRUE; 
         }
    }

}

?>