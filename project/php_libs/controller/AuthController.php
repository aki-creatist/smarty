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
        //コストパラメーターとして2桁の数字を設定する
        $cost = 10; //数字を大きくすると堅牢になるが、システムの負荷が増大する
        
        // PHP7
        //$rondom = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
        // PHP5
        $rondom = random_bytes(16);                  //ソルトを作成するため関数でランダムなデータを生成
        $base64_encode = base64_encode($rondom);     //さらに`base64_encode`で文字列を半角の英数字列にする (`+`が入る)
        $salt = strtr($base64_encode, '+', '.');     //そのため`strstr関数`で `.` に変換する
        $salt = sprintf("$2y$%02d$", $cost) . $salt; //`sprintf関数`で`%02d`の部分に`10`が入る (`$2y$10$文字列`となる)
        
        //ハッシュ値を生成する                           //crypt関数は一つ目の引数にパスワードを、二つ目の引数にソルト指定する
        $hash = crypt($password, $salt);             //ソルトの先頭の文字列によりどのハッシュアルゴリズムを利用するか決められる (今回は`$2y$`を利用)
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
