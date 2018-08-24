CREATE database store_db DEFAULT CHARACTER SET utf8;

CREATE TABLE product_tb (
  product_id int not null auto_increment primary key ,
  product_name varchar(100) not null,
  price int not null ,
  stock int not null default 0,
  detail text not null
);

INSERT INTO product_tb (
  product_name ,
  price  ,
  detail
) VALUES
('りんご',120 ,'とてもおいしいりんごです。'),
('みかん',100 ,'とてもおいしいみかんです。'),
('もも',200 ,'とてもおいしいももです。'),
('ぶどう',250,'とてもおいしいぶどうです。'),
('さくらんぼ',300,'とてもおいしいさくらんぼです。');

CREATE TABLE order_tb (
   order_id int not null auto_increment primary key,
   order_date datetime not null,
   customer_id int not null
);

INSERT INTO order_tb (
 order_date,
 customer_id
)
VALUES
('2014/8/1',2),
('2014/7/1',2),
('2014/7/1',3),
('2014/6/1',1),
('2014/5/1',2);


CREATE TABLE order_detail_tb (
  order_detail_id int not null auto_increment primary key,
  order_id int not null ,
  product_id int not null,
  product_count int not null
);

INSERT INTO order_detail_tb (
    order_id,
    product_id,
    product_count
)
VALUES
(1,5,1),
(1,4,2),
(1,2,10),
(2,1,3),
(2,2,4),
(3,1,2),
(3,3,4),
(3,4,3),
(3,5,2),
(4,2,3),
(4,1,5),
(5,5,7);

CREATE TABLE customer_tb (
 customer_id int not null auto_increment primary key,
 customer_name varchar(20) not null ,
 customer_age int not null,
 address varchar(200) not null
);

INSERT INTO customer_tb (
 customer_name,
 customer_age,
 address
) VALUES
('松本賀生',34,'千葉県'),
('山田太郎',23,'東京都'),
('鈴木次郎',31,'神奈川');


/* 注文と顧客のリレーション */
SELECT
   ord.order_id,
   cus.customer_name
FROM
   order_tb ord
JOIN
  customer_tb cus
ON
  ord.customer_id = cus.customer_id;

/* order_tbとorder_detail_tbとproduct_tbの結合 */

SELECT
  ord.order_id,
  pro.product_id,
  pro.price,
  order_detail.product_count,
  pro.price *  order_detail.product_count AS sales
FROM
  order_tb ord
JOIN
  order_detail_tb order_detail
ON
  ord.order_id = order_detail.order_id
JOIN
  product_tb pro
ON
  order_detail.product_id = pro.product_id


/* 集計 */
SELECT
  ord.order_id,
  SUM(order_detail.product_count),
  SUM(pro.price *  order_detail.product_count )AS sales
FROM
  order_tb ord
JOIN
  order_detail_tb order_detail
ON
  ord.order_id = order_detail.order_id
JOIN
  product_tb pro
ON
  order_detail.product_id = pro.product_id
GROUP BY
  order_id
ORDER BY
  sales desc;

/* 全員の明細 */
SELECT
    cus.customer_name  ,
    ord.order_id ,
    pro.product_name ,
    pro.price,
    detail.product_count ,
    pro.price * detail.product_count AS total
FROM
    customer_tb cus
JOIN
    order_tb ord
ON
    cus.customer_id = ord.customer_id
JOIN
    order_detail_tb detail
ON
    ord.order_id = detail.order_id
JOIN
    product_tb pro
on
    detail.product_id = pro.product_id
ORDER BY
    cus.customer_id desc

/*  客別売上リスト  */
SELECT
    cus.customer_name  ,
    SUM( pro.price * detail.product_count  ) AS sales
FROM
    customer_tb cus
JOIN
    order_tb ord
ON
    cus.customer_id = ord.customer_id
JOIN
    order_detail_tb detail
ON
    ord.order_id = detail.order_id
JOIN
    product_tb pro
ON
   detail.product_id = pro.product_id
GROUP BY
 cus.customer_id
ORDER BY
 sales desc;


/*トランザクション処理 在庫管理*/
use information_schema;
SELECT table_name, engine FROM tables WHERE table_name IN ( 'product_tb', 'order_tb','order_detail_tb','customer_tb' ) ;

/* 在庫情報を保持 */
UPDATE product_tb SET stock = 10;

/*
りんご2コを買う場合

プロセス1 在庫を減らす
プロセス2 カートの中に入れる
という2つのプロセスに整合性を持たせなければいけない
 (片方だけではダメ)
 */

use store_db;
 SET AUTOCOMMIT=0;

/* プロセス 1 */

START TRANSACTION;
UPDATE product_tb SET stock = stock - 2 WHERE product_id  = 1;

/* プロセス 2 */
INSERT INTO order_tb (
 order_date,
 customer_id
)
VALUES
('2014/10/1',1);

ROLLBACK; /*  元に戻せる */

/* 反映されていないことを確認 */
select * from order_tb;
select * from  product_tb;
select * from order_detail_tb;

さっきの処理

INSERT INTO order_detail_tb (
  order_id,
  product_id,
  product_count
) VALUES (
  LAST_INSERT_ID() ,1,2);


上記を修正して再実行
ラストに
COMMIT;

ROLLBACK; /* ROLLBACKしても戻らない */
