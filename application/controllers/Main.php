<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public $layout = 'default';

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Auth/Auth");

        $this->auth->loginCheck();
    }

	public function index()
	{
        $this->dashboard();
	}

    public function dashboard()
    {
        $this->load->view('main/sampleMainPage');
	}
}
