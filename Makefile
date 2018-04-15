init:

	#郵便局のHPからken_all.zipをダウンロード
	wget http://www.post.japanpost.jp/zipcode/dl/kogaki/zip/ken_all.zip
	unzip ken_all.zip
	rm -r ken_all.zip
	#Shift_JISな文字コードを UTF-8 に変換
	nkf -w --overwrite KEN_ALL.CSV
	#変換できたかチェック
	nkf -g KEN_ALL.CSV
	#MySQLから触れるディレクトリにCSVをコピー
	mv ./KEN_ALL.CSV ./database/mysql/ken_all.csv
	cp -R database laradock/database

	#Smarty
	composer update
	mv vendor project/php_libs/

	#Pager
	git clone git@github.com:pear/Pager.git
	sed -ie "s/Pager\/Common.php/Common.php/g" Pager/Pager/Jumping.php
	cp -R Pager/Pager project/php_libs/class/controller/base
	rm -rf Pager
