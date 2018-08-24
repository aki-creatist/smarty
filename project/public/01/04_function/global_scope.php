<?php
//関数内で「１」が加算され、「６」を表示する。

$data = 5; //グローバルスコープの変数

function scope_test()
{
    global $data; 	//グローバルスコープの変数を参照
    $data += 1;     // 5 + 1
    echo $data;
}

echo $data; // 5
scope_test(); // 6
echo $data; // 6
