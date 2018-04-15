CREATE TABLE IF NOT EXISTS `project`.`zipcode` (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  jis_code VARCHAR(255),
  zip_old VARCHAR(255),
  zip VARCHAR(255),
  pref_ruby VARCHAR(255),
  city_ruby VARCHAR(255),
  town_ruby VARCHAR(255),
  pref VARCHAR(255),
  city VARCHAR(255),
  town VARCHAR(255),
  flag1 TINYINT,
  flag2 TINYINT,
  flag3 TINYINT,
  flag4 TINYINT,
  flag5 TINYINT,
  flag6 TINYINT,
  PRIMARY KEY (id),
  KEY zip (zip)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

