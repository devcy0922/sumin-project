<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public $yield = false;
    public $layout = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Auth/Auth");

    }

    public function index()
    {

        $this->load->view('login/login');
    }

    public function loginProc()
    {
        $user_id = $_POST['user_id'];
        $password = $_POST['password'];

        $userRow = $this->UserModel->loginCheck($user_id, $password);
        $this->session->set_userdata('user_id', $userRow['user_id']);

        if( !$userRow ){
            redirect('/login');
        }

        redirect('/sample');
    }

    public function logout()
    {
        $this->auth->logout();

        redirect('/sample');
    }

}
