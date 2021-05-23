<?php


class UserModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function registUser($param = []): int
    {

        $insertParam = [
            "user_id" => $param['user_id'],
            "user_name" => $param['user_name'],
            "password" => md5($param['password'])
        ];

        $insertId = $this->db->insert("user", $insertParam);
        return $insertId;
    }

    public function findById(int $id = 0)
    {
        $row = $this->db->query("
            select * 
            from user 
            where id = ?
        ", [$id])->row_array();

        return $row;
    }

    public function loginCheck($user_id = "", $password = "")
    {
        $password = md5($password);
        $row = $this->db->query("
            select * 
            from user 
            where user_id = ? and password = ?
        ", [
            $user_id,
            $password,
        ])->row_array();

        if (!empty($row)) unset($row['password']);

        return $row;
    }

}