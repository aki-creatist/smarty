CREATE TABLE IF NOT EXISTS `project`.`member_postcode` (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  member_id INT NOT NULL, FOREIGN KEY (member_id) REFERENCES members(id),
  postcode_id INT UNSIGNED NOT NULL, FOREIGN KEY (postcode_id) REFERENCES postcode(id),
  address VARCHAR(50),
  PRIMARY KEY(id)
);
