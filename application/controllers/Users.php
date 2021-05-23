<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public $layout = 'default';
    public $APP_TITLE = '제목';

    public function __construct()
    {
        parent::__construct();

    }

	public function index()
	{

//		$this->load->view('welcome_message');
	}

    public function test()
    {
        echo 'test';
	}
}
