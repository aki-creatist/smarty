<?php
class Session
{
    public $session_key = '';
    public $db = NULL;
    public function __construct($db)
    {
        // セッションをスタートする
        session_start();
        // セッションIDを取得する
        $this->session_key = session_id();
        // DBの登録
        $this->db = $db;
    }
    public function setLoginId($login_id)
    {
        $_SESSION["login_id"] = $login_id;
    }
    public function getLoginId()
    {
        return $_SESSION["login_id"];
    }
    public function checkSession()
    {
        //セッションIDのチェック
        $customer_no = $this->selectSession();
        //セッションＩＤがある(過去にショッピングカートにきたことがある)
        if ($customer_no !== false) {
            $_SESSION['customer_no'] = $customer_no;
        } else {
            //セッションＩＤがない(はじめてこのサイトにきている)
            $res = $this->insertSession($this->db);
            if ($res ===  true) {
                $_SESSION['customer_no'] = $this->db->getLastId();
            } else {
                $_SESSION['customer_no'] = '';
            }
        }
    }
    private function selectSession()
    {
        $table = 'sessions';
        $col   = 'customer_no';
        $where = 'session_key=?';
        $where_value = [$this->session_key];
        $res = $this->db->select($table, $col, $where, $where_value);
        return (count($res) !== 0) ? $res[0]['customer_no'] : false;
    }
    private function insertSession()
    {
        $table    = 'sessions';
        $ins_data =  ['session_key ' => $this->session_key];
        $res      = $this->db->insert($table, $ins_data);
        return $res;
    }
}