<?php

$memberArr = [
    [
        "name" => "山田",
        "age" => "19",
        "sex" => "1"
    ],
    [
        "name" => "鈴木",
        "age" => "22",
        "sex"=>"0"
    ],
    [
        "name" => "田中",
        "age" => "18",
        "sex"=>"1"
    ],
    [
        "name" => "渡辺",
        "age" => "25",
        "sex" => "0"
    ],
    [
        "name" => "佐藤",
        "age" => "33",
        "sex" => "1"
    ]
];

foreach ($memberArr as $member) {
    if ($member['age'] < 20) {
        echo $member['name'] . "さんは未成年なのでまだお酒は飲めません<br>";
    } else {
        echo $member['name'] . "さん、飲みすぎには注意しましょう！<br>";
    }
}
