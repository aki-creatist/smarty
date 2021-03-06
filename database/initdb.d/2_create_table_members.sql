CREATE TABLE IF NOT EXISTS `project`.`members` (
  id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(255),
  password VARCHAR(128),
  last_name VARCHAR(20),
  first_name VARCHAR(20),
  last_name_kana VARCHAR(20),
  first_name_kana VARCHAR(20),
  gender TINYINT(1) UNSIGNED,
  birthday VARCHAR(8),
  tel VARCHAR(11),
  contents TEXT,
  deleted_at DATETIME DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  delete_flg TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY(id)
);


