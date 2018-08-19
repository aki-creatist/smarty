LOAD DATA LOCAL INFILE '/var/lib/mysql-files/contents.csv'
INTO TABLE `project`.`contents`
FIELDS
  TERMINATED BY ','
  ENCLOSED BY '"'
(
  id,
  name,
  contents
);

LOAD DATA LOCAL INFILE '/var/lib/mysql-files/members.csv'
INTO TABLE `project`.`members`
FIELDS
  TERMINATED BY ','
  ENCLOSED BY '"'
(
  username,
  password,
  last_name,
  first_name,
  last_name_kana,
  first_name_kana,
  gender,
  birthday,
  tel,
  contents
);

LOAD DATA LOCAL INFILE '/var/lib/mysql-files/traffics.csv'
INTO TABLE `project`.`traffics`
FIELDS
  TERMINATED BY ','
  ENCLOSED BY '"'
(
  id,
  name
);

LOAD DATA LOCAL INFILE '/var/lib/mysql-files/ken_all.csv'
INTO TABLE `project`.`zipcode`
FIELDS
  TERMINATED BY ','
  OPTIONALLY ENCLOSED BY '"'
  ESCAPED BY ''
LINES
  STARTING BY ''
  TERMINATED BY '\r\n'
(
  jis_code,
  zip_old,
  zip,
  pref_ruby,
  city_ruby,
  town_ruby,
  pref,
  city,
  town,
  flag1,
  flag2,
  flag3,
  flag4,
  flag5,
  flag6
);

LOAD DATA LOCAL INFILE '/var/lib/mysql-files/ken_all.csv'
INTO TABLE `project`.`postcode`
FIELDS
  TERMINATED BY ','
  OPTIONALLY ENCLOSED BY '"'
  ESCAPED BY ''
LINES
  STARTING BY ''
  TERMINATED BY '\r\n'
(
  jis_code,
  zip_old,
  zip,
  pref_ruby,
  city_ruby,
  town_ruby,
  pref,
  city,
  town,
  flag1,
  flag2,
  flag3,
  flag4,
  flag5,
  flag6
);

LOAD DATA LOCAL INFILE '/var/lib/mysql-files/member_traffics.csv'
INTO TABLE `project`.`member_traffics`
FIELDS
  TERMINATED BY ','
  ENCLOSED BY '"'
(
  id,
  member_id,
  traffic_id
);


LOAD DATA LOCAL INFILE '/var/lib/mysql-files/member_zipcode.csv'
INTO TABLE `project`.`member_zipcode`
FIELDS
  TERMINATED BY ','
  ENCLOSED BY '"'
(
  id,
  member_id,
  zipcode_id,
  address
);

LOAD DATA LOCAL INFILE '/var/lib/mysql-files/member_postcode.csv'
INTO TABLE `project`.`member_postcode`
FIELDS
  TERMINATED BY ','
  ENCLOSED BY '"'
(
  id,
  member_id,
  postcode_id,
  address
);

LOAD DATA LOCAL INFILE '/var/lib/mysql-files/system.csv'
INTO TABLE `project`.`system`
FIELDS
  TERMINATED BY ','
  ENCLOSED BY '"'
(
  username,
  password
);
