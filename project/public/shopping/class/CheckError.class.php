<?php

class CheckError
{
    public $errors = [];

    //初期化
    public function __construct()
    {
        $this->errors = [
            'name' => '',
            'price'     => '',
            'image'     => ''
        ];
    }

    //$_FILESのエラーを解消する手立てを探して文章で解凍する。
    public function errorCheck($data, $global_files)
    {
        $this->data = $data;

        $this->nameCheck();
        $this->priceCheck();
        $this->imageCheck($global_files);
        return $this->errors;
    }

    public function nameCheck()
    {
        if ($this->data['name'] === '') $this->errors['name'] = '名前を入力してください';
    }

    public function priceCheck()
    {
        if ($this->data['price'] === '') {
            $this->errArr['price'] = '価格を入力してください。';
        } elseif (is_numeric($this->data['price']) === false) {
            $this->errors['price'] = '形式が正しくありません。';
        }
    
    }

    public function imageCheck($global_files)
    {
        if ($global_files["image"]["error"] !== 4) {
            $tmp_image = $global_files['image'];

            if ($tmp_image['error'] === 0 && $tmp_image['size'] !== 0) {

                if (is_uploaded_file($tmp_image['tmp_name']) === true) {
                    $image_info = getimagesize($tmp_image['tmp_name']);
                    $image_mime = $image_info['mime'];
                }

                if ($tmp_image['size'] > 1048576) {
                    $this->errors["image"] = "アップロードできる画像のサイズは1MBまでです";
                } elseif (preg_match('/^image\/jpeg$/', $image_mime) === 0 ) {
                    $this->errors["image"] = "アップロードできる画像の形式はJPEG形式だけです";
                } 
            }
        }
    }

    public function getErrorFlg()
    {
        $err_check = true;
        foreach($this->errors as $key => $value) {
            if ($value !== '') $err_check = false;
        }

        return $err_check;
    }
}

