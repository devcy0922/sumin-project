<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth
{
    public function loginCheck()
    {
        $CI =& get_instance();
        $loginCheck = $CI->session->userdata('user_id') ? true : false;

        if( $loginCheck === false ){
            redirect('/login');
        }else{
            return $loginCheck;
        }

    }

    public function logout()
    {
        $CI =& get_instance();
        $CI->session->set_userdata('user_id', null);
        redirect('/login');
    }
}