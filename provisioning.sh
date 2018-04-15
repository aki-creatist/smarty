#!/bin/bash

cd ${HOME}/${WORKSPACE}
git clone git@github.com:aki-creatist/smartyapp.git app

cd app
#タグを指定してクローン(最新版はうまくいかないため)
git clone --depth=1 -b v5.5.1 https://github.com/LaraDock/laradock.git
cp -R database laradock/
cd laradock

FILE=docker-compose.yml
sed -ie 's/}:\/var\/www/}\/project:\/var\/www/g' ${FILE}
sed -ie 's/}\/mysql:\/var\/lib\/mysql/}\/mysql:\/var\/lib\/mysql-files/g' ${FILE}
sed -ie 's/mysql\/docker-entrypoint-/database\//g' ${FILE}

cp env-example .env

FILE=.env
sed -ie 's/~\/.laradock\/data/.\/database/g' ${FILE}
sed -ie 's/UTC/JST-9/g' ${FILE}
sed -ie 's/MYSQL_DATABASE=default/MYSQL_DATABASE=project/g' ${FILE}
sed -ie 's/MYSQL_USER=default/MYSQL_USER=user/g' ${FILE}
sed -ie 's/MYSQL_PASSWORD=secret/MYSQL_PASSWORD=pass/g' ${FILE}
sed -ie 's/MYSQL_ROOT_PASSWORD=root/MYSQL_ROOT_PASSWORD=pass/g' ${FILE}

echo "DB_HOST=mysql" >> ${FILE}
echo "REDIS_HOST=redis" >> ${FILE}
echo "QUEUE_HOST=beanstalkd" >> ${FILE}

rm -rf laradock/.enve
rm -rf laradock/docker-compose.ymle
rm -rf laradock/.git