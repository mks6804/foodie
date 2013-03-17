<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function flashData() 
{ 
    $ci =& get_instance();
    $type = $ci->session->flashdata('type'); 
    switch($type){
        case 'error': 
            $type = 'alert'; 
            break; 
        case 'success': 
            $type = 'success';
            break;
        default: 
            $type = 'secondary';
    }
    $msg = $ci->session->flashdata('message'); 
    $flashmsg = '';
    if(!empty($msg)){
        $flashmsg .= '<div class="alert-box '. $type . '">';
        $flashmsg .= $msg; 
        $flashmsg .= '<a href="" class="close">&times;</a></div>';
    }
    return $flashmsg;     
} 