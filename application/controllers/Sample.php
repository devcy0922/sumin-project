<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sample extends CI_Controller
{

    public $layout = 'default';

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Auth/Auth");

        $this->auth->loginCheck();

    }

    public function index()
    {
        $this->chart();
    }

    public function loginProc()
    {
        $user_id = $_POST['user_id'];
        $password = $_POST['password'];

        $userRow = $this->userModel->loginCheck($user_id, $password);



        exit(json_encode(returnData(true, $userRow)));
    }

    /**
     * view
     */
    public function chart()
    {
        $this->load->view('sample/chart');
    }

    /**
     * API sample
     */
    public function chartAPI()
    {
        /**
         * param - POST PUT DELETE 로 받는 데이터
         * data - 뷰에 전달할 배열
         */
        $sampleCount = $_POST['length'] ?? 5;
        $sampleData = [];

        $colorList = [
            "red", "orange", "yellow", "green", "info", "blue", "purple", "grey"
        ];

        for ($i = 0; $i < $sampleCount; $i++) {
            $randArr = rand( 0, count($colorList) - 1 );
            $row = [
                "labels" => "labels{$i}",
                "backgroundColor" => $colorList[$randArr],
                "data" => rand(0, 100)
            ];
            $sampleData[] = $row;
        }


        exit(json_encode(returnData(true, $sampleData)));

    }

}
