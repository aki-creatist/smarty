<?php
class PDODatabase
{
    private $pdo;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        try {
            switch (DB_TYPE) {
                case 'mysql':
                    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
                    break;
                case 'pgsql':
                    $dsn = 'pgsql:dbname=' . DB_NAME.' host=' . DB_HOST . ' port=5432';
                    break;
            }
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('接続エラー:' . $e->getMessage());
        }
    }

    public function select($table, $column ='', $where = '', $arrVal = [])
    {
        $sql = $this->getSql('select', $table, $where, $column);

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($arrVal);
        //データを連想配列に格納
        $data = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($data, $result);
        }
        return $data;
    }

    public function first($table, $column ='', $where = '')
    {
        $sql = $this->getSql('select', $table, $where, $column);
        $sql .= " limit 1 ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetch();
        return $data;
    }

    private function getSql($type, $table, $where = '', $column = '')
    {
        switch ($type) {
            case 'select':
                $column_key = ($column !== '') ? $column : "*";
                break;
        }
        $where_sql = ($where !== '') ? ' WHERE  ' . $where : '';
        $sql = " SELECT "
            .    $column_key
            ." FROM "
            .    $table
            .    $where_sql
        ;
        return $sql;
    }

    public function execute($query = '', $values = [])
    {
        $stmt = $this->pdo->prepare($query);
        $bool = $stmt->execute($values);
        return $bool;
    }

    public function insert($table, $ins_data = [])
    {
        list($pre_st, $ins_data_val, $columns) = $this->getPreparedStatement('insert', $ins_data, $table);
        $sql = "INSERT INTO " . $table . "("
            .    $columns
            . ")VALUES("
            .    $pre_st
            . ")"
        ;
        $bool = $this->execute($sql, $ins_data_val);
        return $bool;
    }

    public function update($table, $values, $where)
    {
        $sql = " UPDATE "
            .    $table
            . " SET "
            .    $values
            . " WHERE "
            .    $where
        ;
        $bool = $this->execute($sql);
        return $bool;
    }

    public function getPreparedStatement($mode, $insData)
    {
        if (!empty($insData)) {
            $insDataKey = array_keys($insData);
            $insDataVal = array_values($insData);
            $preCnt     = count($insDataKey);
            switch ($mode) {
                case 'insert':
                    $columns  = implode(",", $insDataKey);
                    $arrPreSt = array_fill(0, $preCnt,'?');
                    $preSt    = implode(",", $arrPreSt);
                    return array($preSt, $insDataVal, $columns);
                    break;
                case 'update':
                    for ($i=0; $i < $preCnt; $i++) {
                        $arrPreSt[$i] = $insDataKey[$i] . " =? ";
                    }
                    $preSt = implode(",", $arrPreSt);
                    return [$preSt, $insDataVal];
                    break;
            }
        } else {
            return false;
        }
    }

    public function getLastId()
    {
        return $this->pdo->lastInsertId();
    }
}