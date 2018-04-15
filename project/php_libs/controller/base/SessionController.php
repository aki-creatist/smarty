<?php
class SessionController
{
    protected $sessname; // セッション名
    public function __construect()
    {
        //
    }

    public function setSessName($name)
    {
        $this->sessname = $name;
    }

    public function getSessName()
    {
        return $this->sessname;
    }

    public function start()
    {
        // セッションが既に開始している場合は何もしない。
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }
        if ($this->sessname != "") {
            session_name($this->sessname);
        }
        // セッション開始
        session_start();
    }

    // 認証情報を破棄
    public function logout()
    {
        // セッション変数を空にする
        $_SESSION = [];
        // クッキーを削除
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        // セッションを破壊
        session_destroy();
    }
}