-- 1-1 DBの作成
CREATE database person_db DEFAULT CHARACTER SET utf8;

-- 1-2 ユーザーの作成
GRANT ALL PRIVILEGES ON person_db.* to person_user@'%' IDENTIFIED by 'person_pass' WITH GRANT OPTION;

-- 1-3 テーブルの作成
USE person_db;

CREATE TABLE person_tb(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL,
    age INT(11) NOT NULL,
    language VARCHAR(20) NOT NULL
);

desc person_tb;

-- 1-4 データの挿入
INSERT INTO person_tb(
    name,
    age,
    language
) VALUES
('yamadata',19,'PHP'),
('suzuki',22,'Java'),
('tanaka',18,'Ruby'),
('watanabe',25,'C'),
('satou',33,'Perl');

SELECT * from person_tb;

-- 1-5 データの検索
SELECT * from person_tb where age > '20';

-- 1-6 データの更新
UPDATE person_tb SET age = 23, language = 'Python' WHERE id = 2;

-- 1-7 平均値の算出
SELECT sum(age) as '合計' , avg(age) as '平均' FROM person_tb;

