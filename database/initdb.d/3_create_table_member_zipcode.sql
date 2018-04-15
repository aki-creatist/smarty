CREATE TABLE IF NOT EXISTS `project`.`member_zipcode` (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  member_id INT NOT NULL, FOREIGN KEY (member_id) REFERENCES members(id),
  zipcode_id INT UNSIGNED NOT NULL, FOREIGN KEY (zipcode_id) REFERENCES zipcode(id),
  address VARCHAR(50),
  PRIMARY KEY(id)
);
