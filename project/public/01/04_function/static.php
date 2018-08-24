<?php

counter(); // 1
counter(); // 2
counter(); // 3

// 以下はUndefined variable (参照は不可)
// echo $data;

/**
 * 関数内変数をstatic宣言し、実行ごとにカウントアップ
 */
function counter()
{
    static $data = 0; // static宣言しない場合 毎度1を表示する
    echo $data += 1;
}