CREATE TABLE IF NOT EXISTS `project`.`items` (
    id int unsigned not null auto_increment,
    name varchar(100) not null,
    detail text not null,
    price DECIMAL(10,3) unsigned not null,
    image varchar(50) not null,
    category_id tinyint unsigned not null,
    primary key( id ),
    index item_idx( category_id )
);
CREATE TABLE IF NOT EXISTS `project`.`carts` (
    id int unsigned not null auto_increment,
    customer_no int unsigned not null,
    item_id int unsigned not null,
    num tinyint(1) unsigned not null default 1,
    delete_flg tinyint(1) unsigned not null default 0,,
    primary key( id ),
    index crt_idx( customer_no, delete_flg )
);
CREATE TABLE IF NOT EXISTS `project`.`categories` (
    id tinyint unsigned not null auto_increment,
    name varchar(100) not null,
    primary key(id)
);
CREATE TABLE IF NOT EXISTS `project`.`sessions` (
    customer_no int unsigned not null auto_increment,
    session_key varchar(32),
    primary key(customer_no)
);