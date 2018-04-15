<?php
require_once '../../php_libs/init.php';

$db = new Database();

if (isset($_GET['zip1']) === true && isset($_GET['zip2']) === true) {
    $zip1 = $_GET['zip1'];
    $zip2 = $_GET['zip2'];

    $table = 'postcode';
    $columns = 'pref, city, town';
    $where = 'zip =' . $zip1 . $zip2;

    $res = $db->select($table, $columns, $where);

    // echo 出力結果がajaxに渡される
    if ($res !== "" && count($res) !== 0) {
        $pref = $res[0]['pref'];
        $city = $res[0]['city'];
        $town = $res[0]['town'];
        echo $pref . $city . $town;
    } else {
        echo "";
    }
} else {
    echo "no";
}
