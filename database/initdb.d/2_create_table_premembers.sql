CREATE TABLE IF NOT EXISTS `project`.`premembers` (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(255),
  password VARCHAR(128),
  last_name VARCHAR(20),
  first_name VARCHAR(20),
  last_name_kana VARCHAR(20),
  first_name_kana VARCHAR(20),
  gender TINYINT(1) UNSIGNED,
  birthday VARCHAR(8),
  zip VARCHAR(7),
  address VARCHAR(100),
  tel VARCHAR(11),
  contents TEXT,
  traffic VARCHAR(20),
  link_pass VARCHAR(128),
  PRIMARY KEY(id)
);