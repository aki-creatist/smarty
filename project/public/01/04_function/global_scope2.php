<?php
$data = 5; //グローバルスコープの変数

function scope_test()
{
    $GLOBALS['data'] += 1; // グローバルスコープの変数を参照
    echo $GLOBALS['data'];
}

echo $data;
scope_test();
echo $data;
