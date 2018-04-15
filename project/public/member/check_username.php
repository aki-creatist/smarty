<?php
require_once '../../php_libs/init.php';

$db = new Database();

if (isset($_GET['username']) === true) {
    $username = $_GET['username'];

    $table = 'members';
    $where = 'username =' . "'" . $username . "'";

    $count = $db->count($table, $where);

    if ($count >= 1) echo $username;
} else {
    echo "no";
}
