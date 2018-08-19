<?php

class Auth
{
    private $db = NULL;

    public function __construct($db = NULL)
    {
        $this->db = $db;
    }

    public function isAccount($login_id, $password)
    {
        $table ='members';

        $username = "username=" . "'" . $login_id . "'";
        $password = "password=" . "'" . $password . "'";
        $where = $username . ' AND ' . $password;

        $account = $this->db->count($table, $where);

        switch ($account) {
        case 0: 
            return false;
            break;
        case 1: 
            return true;
            break;
        }
    }
}
