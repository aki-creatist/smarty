<?php
class AuthController extends Database
{
    const TABLE = 'members';
    private $auth_name; // 認証情報の格納先名

    public function setAuthName($name)
    {
        $this->auth_name = $name;
    }

    public function getAuthName()
    {
        return $this->auth_name;
    }

    public function check()
    {
        if (!empty($_SESSION[$this->getAuthName()])) {
            if ($_SESSION[$this->getAuthName()]['id'] >= 1) {
                return true;
            } else {
                return false;
            }
        } else {
            echo "Sessionの値が空です。";
            return false;
        }
    }

    public function getUser($username)
    {
        $where = 'username=' . "'" . $username . "'";
        $data = $this->first(self::TABLE, $where);
        return $data;
    }

    public function getHashedPW($password)
    {
        $cost = 10;
        // PHP7
        //$rondom = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
        // PHP5
        $rondom = random_bytes(16);
        $base64_encode = base64_encode($rondom);
        $salt = strtr($base64_encode, '+', '.');
        $salt = sprintf("$2y$%02d$", $cost) . $salt;
        $hash = crypt($password, $salt);
        return $hash;
    }

    public function checkPW($password, $hashed_password)
    {
        $hash = crypt($password, $hashed_password);
        if ($hash == $hashed_password) {
            return true;
        } else {
            return false;
        }
    }

    public function authOK($userdata)
    {
        session_regenerate_id(true);
        $_SESSION[$this->getAuthName()] = $userdata;
    }

    public function authNG()
    {
        return 'ユーザ名かパスワードが間違っています。' . "\n";
    }
}
