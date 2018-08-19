-- shopping
LOAD DATA LOCAL INFILE '/var/lib/mysql-files/3_carts.csv'
INTO TABLE `project`.`carts`
FIELDS
  TERMINATED BY ','
  ENCLOSED BY '"'
(
  id,
  customer_no,
  item_id,
  num,
  delete_flg
);

LOAD DATA LOCAL INFILE '/var/lib/mysql-files/categories.csv'
INTO TABLE `project`.`carts`
FIELDS
  TERMINATED BY ','
  ENCLOSED BY '"'
(
  id,
  name
);

LOAD DATA LOCAL INFILE '/var/lib/mysql-files/items.csv'
INTO TABLE `project`.`carts`
FIELDS
  TERMINATED BY ','
  ENCLOSED BY '"'
(
  id,
  name,
  detail,
  price,
  image,
  category_id
);