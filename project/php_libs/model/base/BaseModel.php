<?php

class BaseModel
{
    protected $pdo;
    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        try {
            switch (TYPE) {
                case 'mysql':
                    $dsn = 'mysql:host=' . HOST . ';dbname=' . NAME . ';charset=utf8';
                    break;
                case 'pgsql':
                    $dsn = 'pgsql:dbname=' . NAME.' host=' . HOST . ' port=5432';
                    break;
            }
            $this->pdo = new PDO($dsn, USER, PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('接続エラー:' . $e->getMessage());
        }
    }
}