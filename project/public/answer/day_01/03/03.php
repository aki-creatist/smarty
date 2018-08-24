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

$man_cnt=0;
$man_age_sum=0;
$woman_cnt=0;
$woman_age_sum=0;

foreach ($memberArr as $member) {
    switch ($member["sex"]) {
        case "1":
            $man_cnt++;
            $man_age_sum += $member["age"];
            break;
        case "0":
            $woman_cnt++;
            $woman_age_sum += $member["age"];
            break;
    }
}

echo "男性の人数: " . $man_cnt ."<br>";
echo "男性の平均年齢: " . round($man_age_sum / $man_cnt,1) . "才<br>";
echo "女性の人数: " . $woman_cnt ."<br>";
echo "女性の平均年齢: " . round($woman_age_sum / $man_cnt,1) . "才<br>";