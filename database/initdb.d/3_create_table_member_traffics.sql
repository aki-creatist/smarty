CREATE TABLE IF NOT EXISTS `project`.`member_traffics` (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  member_id INT NOT NULL, FOREIGN KEY (member_id) REFERENCES members(id),
  traffic_id INT NOT NULL, FOREIGN KEY (traffic_id) REFERENCES traffics(id),
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
);

