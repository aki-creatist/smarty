<?php

// opendir関数でカレントディレクトリ(実行しているファイルのあるディレクトリ)をオープン
// ディレクトリ・ハンドルをオープンして変数に格納

if ($dirhandle = opendir('.')) {
    // readdir関数が$dirhandleを使って次のファイル名またはディレクトリ名を$fileに格納
    while (false !== ($filename = readdir($dirhandle))) { // $fileに名前が格納される限り処理を続ける
        echo $filename ."<br>";
    }
    // ファイル名がなくなるとループを抜ける
    closedir($dirhandle); // オープンしたディレクトリ・ハンドルの$dirhandleを閉じる
}