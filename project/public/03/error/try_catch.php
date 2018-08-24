<?php

function calc($num1,$num2)
{
    if ($num2 == 0) {
        throw new Exception("0では除算不可");
    }
    return $num1 / $num2;
}

try {                                 // tryブロックは異常が発生する可能性のある処理を記述
    echo calc(6,0);
} catch (Exception $e) {              //例外のときの処理を記述する
    echo "エラー：" . $e->getMessage();
}