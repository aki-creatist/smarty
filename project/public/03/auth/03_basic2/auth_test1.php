<?php
/*
 * プログラム内部のIDとPWで認証をする
 * 当ディレクトリ内の３つのファイルが連動する
 * 認証画面を表示
 * Member Onlyの文字列が認証画面に表示される
 */
header("WWW-Authenticate: Basic realm=\"Member Only\"");
header("HTTP/1.0 401 Unauthorized");
?>
