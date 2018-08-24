<?php

$memberArr = [
    [
        'name' => "田中",
        'age'  => 22,
        "pref" => "千葉",
        "sex"  => "男",
        "language"=> "C"
    ],
    [
        'name' => "鈴木",
        'age'  => 19,
        "pref" => "東京",
        "sex"  => "女",
        "language" => "Java"
    ],
    [
        'name'	=> "吉田",
        'age'	=> 27,
        "pref"  => "神奈川",
        "sex"   => "男",
        "language" => "C++"
    ]
];

$member = [
    "name" => "渡辺",
    "age"  => 26,
    "pref" =>  "大阪",
    "sex"  =>  "男",
    "language" => "Perl"
];

$memberArr[3] = $member;

echo "<table border='1px'>";
echo "<tr>";
echo "<th>名前</th>";
echo  "<th>年齢</th>";
echo  "<th>出身地</th>";
echo  "<th>性別</th>";
echo  "<th>言語</th>";
echo  "</tr>";

foreach ($memberArr as $member) {
    echo "<tr>";
    echo "<td>" . $member["name"] . "</td>";
    echo "<td>" . $member["age"] . "</td>";
    echo "<td>" . $member["pref"] . "</td>";
    echo "<td>" . $member["sex"] . "</td>";
    echo "<td>" . $member["language"] . "</td>";
    echo "</tr>";
}
echo "</table>";