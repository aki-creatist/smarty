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

echo "<table border='1px'>";
echo "<tr>";
echo "<th>名前</th>";
echo "<th>年齢</th>";
echo "<th>性別</th>";
echo "</tr>";

foreach ($memberArr as $member) {
    echo "<tr>";
    echo "<td>" . $member["name"] . "</td>";
    echo "<td>" . $member["age"] . "</td>";
    echo "<td>";
    echo 'sex' === "1" ? "男" : "女";
    echo "</td>";
    echo "</tr>";
}
echo "<table>";