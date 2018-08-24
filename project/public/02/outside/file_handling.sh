#!/bin/bash

FILE_PATH='var/www/html/outside/'

# ファイルの情報を表示する
php ${FILE_PATH}/pathinfo.php

# test.txtをコピーし、test.bkを作成する
php ${FILE_PATH}/copy.php

# test.txtに書き込む
php ${FILE_PATH}/file_put_contents.php

# test.txtを読み込む
php ${FILE_PATH}/file_get_contents.php

# 文字コードをUTF-8からSJISに変更し、文字化けさせる
php ${FILE_PATH}/mb_convert_encoding.php

# 新規ディレクトリ(./temp)を作成する
php ${FILE_PATH}/mkdir.php

# ディレクトリ(./temp)を削除する
php ${FILE_PATH}/rmdir.php

# test.txtを削除する
php ${FILE_PATH}/unlink.php