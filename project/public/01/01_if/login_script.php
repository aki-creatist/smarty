<?php
$name = "name";
$pass = "pass";

$db_data["name"] = "user";
$db_data["pass"] = "pass";

if ($db_data["name"] == $name && $db_data["pass"] == $pass) {
    // 会員ページの表示
    echo "会員ページです。";
}
