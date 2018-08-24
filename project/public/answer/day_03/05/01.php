<?php
/*
CREATE database counter_db DEFAULT CHARACTER SET utf8;

GRANT ALL PRIVILEGES ON counter_db.* to 'counter_user'@'%' IDENTIFIED by 'counter_pass' WITH GRANT OPTION;
FLUSH PRIVILEGES;
SHOW GRANTS FOR 'counter_user'@'%';

USE counter_db;

CREATE TABLE counter_tb (
    id int not null auto_increment primary key ,
  counter int not null
);
INSERT INTO counter_tb ( counter ) VALUES ( 1 );
*/

$db_host = 'dbserver';
$db_name = 'counter_db';
$db_user = 'counter_user';
$db_pass = 'counter_pass';

// データベースホストへ接続する
$dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';
$dbh = new PDO($dsn, $db_user, $db_pass);

$query  = "SELECT counter FROM counter_tb";

// クエリを実行する
$res = $dbh->query($query);

$row = [];
foreach ($res as $value) {
    $row[] = $value;
}

$counter = intval($row[0]["counter"]);
$counter++;

$stmt = $dbh->prepare('UPDATE counter_tb set counter = :counter');

$stmt->bindParam(':counter', $counter, PDO::PARAM_INT);

$res = $stmt->execute();

if ($res !== false) echo "カウンター　" . $counter;

