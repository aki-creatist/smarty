<?php

$arr = [
    'name' =>'松本',
    'age'=>'33',
    'pref'=>'千葉',
    'sex'=>'男'
];

foreach ($arr as $key => $val) {
    echo $key . ":" . $val . "<br>";
}