<?php
class Validator
{
    private $datas = [];
    private $errors = [];

    //初期化
    public function __construct()
    {
        //
    }

    public function check($datas, $class = '')
    {
        $this->datas = $datas;
        $this->createErrorMessage();

        switch ($class) {
            case 'contents':
                $this->nameCheck();
                $this->contentsCheck();
                break;
            case 'members':
                $this->userNameCheck();
                $this->passwordCheck();
                $this->lastNameCheck();
                $this->firstNameCheck();
                $this->genderCheck();
                $this->birthCheck();
                $this->zipCheck();
                $this->addCheck();
                $this->telCheck();
                $this->trafficCheck();
                break;
        }
        return $this->errors;
    }

    private function createErrorMessage()
    {
        foreach ($this->datas as $key => $val) {
            $this->errors[$key] = '';
        }
    }

    private function nameCheck()
    {
        if ($this->datas['name'] === '') $this->errors['name'] = 'お名前を入力してください';
    }

    private function contentsCheck()
    {
        // エラーチェックを入れる
        if ($this->datas['contents'] === '') $this->errors['contents'] = '本文を入力してください';
    }

    private function userNameCheck()
    {
        if ($this->datas['username'] === '') {
            $this->errors['username'] = 'ユーザネームを入力してください。';
        }
//        if (preg_match(RULE_MAIL, $this->datas["username"] ) === 0) {
//            $this->errors['username'] = 'メールアドレスを正しい形式で入力してください';
//        }
    }

    private function passwordCheck()
    {
        if ($this->datas['password'] === '') {
            $this->errors['password'] = 'パスワードを入力してください。';
        }
    }

    private function lastNameCheck()
    {
        if ($this->datas['last_name'] === '') {
            $this->errors['last_name'] = 'お名前(氏)を入力してください';
        }
    }

    private function firstNameCheck()
    {
        // エラーチェックを入れる
        if ($this->datas['first_name'] === '') {
            $this->errors['first_name'] = 'お名前(名)を入力してください';
        }
    }

    private function genderCheck()
    {
        if ($this->datas['gender']   === '') {
            $this->errors['gender'] = '性別を選択してください';
        }
    }

    private function birthCheck()
    {
        if ($this->datas['year']  === '') {
            $this->errors['year'] = '生年月日の年を選択してください';
        }
        if ($this->datas['month'] === '') {
            $this->errors['month'] = '生年月日の月を選択してください';
        }
        if ($this->datas['day']   === '') {
            $this->errors['day'] = '生年月日の日を選択してください';
        }
        if (checkdate($this->datas["month"],
                $this->datas["day"],
                $this->datas["year"] ) === false) {
            $this->errors['year']  = '正しい日付を入力してください。';
        }
        if (strtotime($this->datas['year'] ."-" . $this->datas['month'] ."-" .$this->datas['day']  ) - strtotime( "now" ) > 0) {
            $this->errors['year']  = '正しい日付を入力してください。';
        }
    }

    private function zipCheck()
    {
        $zip1 = '/^[0-9]{3}$/';
        $zip2 = '/^[0-9]{4}$/';
        if (preg_match($zip1 , $this->datas['zip1']) === 0) {
            $this->errors['zip1'] = '郵便番号の上は半角数字3桁で入力してください';
        }
        if (preg_match($zip2, $this->datas['zip2']) === 0) {
            $this->errors['zip2'] = '郵便番号の下は半角数字4桁で入力してください';
        }
    }


    private function addCheck()
    {
        if ($this->datas['address'] === '') $this->errors['address'] = '住所を入力してください';
    }

    private function telCheck()
    {
        $rule_tel = '/^\d{1,6}$/';
        $tel1 = $this->datas["tel1"];
        $tel2 = $this->datas["tel2"];
        $tel3 = $this->datas["tel3"];
        if (preg_match($rule_tel, $tel1) === 0 ||
            preg_match($rule_tel, $tel2) === 0 ||
            preg_match($rule_tel, $tel3) === 0 ||
            strlen($tel1 . $tel2 . $tel3) >= 12) {
            $this->errors['tel1'] = '電話番号は、半角数字で11桁以内で入力してください';
        }
    }

    private function trafficCheck()
    {
        if ($this->datas["traffic"] === []) {
            $this->errors["traffic"] = '最低1つの交通機関を入力してください。';
        }
    }

    public function getErrorFlg()
    {
        $err_check = true;
        foreach ($this->errors as $key => $value) {
            if ($value !== '') {
                $err_check = false;
            }
        }
        return $err_check;
    }

    //参照渡し
    public function htmlEncode(&$datas)
    {
        foreach($datas as $key => &$data) {
            if (is_array($data) !== true) {
                //読み→htmlスペシャルキャラズ
                $datas[$key] = htmlspecialchars($data, ENT_QUOTES);
            } else { //配列の場合は再帰的な処理が必要になる
                $this->htmlEncode($data);
            }
        }
    }
}
