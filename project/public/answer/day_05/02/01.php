<?php

$genenater = new generater();
$genenater->main();

class generater
{
    private $arr_all;
    private $arr_loop_flg;
    private $all_char_arr;
    private $arr_key;
    private $pass;

    public function __construct()
    {
        $this->arr_loop_flg = [false, false, false, false];
        $this->all_all = [];
        $this->arr_key = ["large_alpha", "small_alpha", "number", "signal"];
        $this->all_char_arr = [];
        $this->pass = [];
    }

    public function main()
    {
        //1 4つのキーを持つ連想配列に入れる
        $this->str_split_to_array();

        while( true ){
            //2 パスワード作成
            $pass = $this->make_passwd();

            //3 全て使われ切ってるかチェック
            //(使われてなければ2にもどる)
            $loop_flg = $this->loop_flg_check();

            if ($loop_flg === true) break;
        }

        //4 パスワードの表示
        echo $pass;
    }

    private function str_split_to_array()
    {
        //配列の作成→連想配列に入れる
        $this->arr_all["large_alpha"] = range("A","Z");
        $this->arr_all["small_alpha"] = range("a","z");
        $this->arr_all["number"] = range(0,9);
        $this->arr_all["signal"] = str_split("!\"#$%&'()");
    }

    private function make_passwd()
    {
        $pass = "";
        $i_leng = rand(12, 16);

        for ($i=1; $i <= $i_leng; $i++) {
            //2-1 どの列を使うかを選ぶ
            //乱数発生
            $arr_key_index = rand(0,3);

            //キーのセット
            $tmp_key = $this->arr_key[$arr_key_index];

            //配列の取り出し
            $tmp_arr = $this->arr_all[$tmp_key];

            //使用済フラグをセット
            $this->arr_loop_flg[$arr_key_index] = true;

            //2-2 どの文字を使うかを選ぶ
            //配列数のチェック
            $char_length = count($tmp_arr)-1;

            //乱数の発生
            $char_index = rand(0,$char_length);

            //文字の決定
            $pass .= $tmp_arr[$char_index];
        }

        return $pass;
    }

    private function loop_flg_check()
    {
        //falseが発見されない→全て使われている
        $loop_flg = true;
        if (array_search(false, $this->arr_loop_flg)) {
            $loop_flg = false;
        }
        return $loop_flg;
    }
}
