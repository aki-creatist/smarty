<?php
class Database extends BaseModel
{
    protected $pdo;
    private  $order   = '';
    private  $limit   = '';
    private  $offset  = '';
    private  $groupby = '';

    public function select($table, $column ='', $where = '', $arrVal = [])
    {
        $sql = $this->getSql('select', $table, $where, $column);
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($arrVal);
        //データを連想配列に格納
        $data = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            array_push($data, $result);
        }
        return $data;
    }
    public function count($table, $where='', $arrVal = [])
    {
        $sql = $this->getSql('count', $table, $where );
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($arrVal);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return intval($result['NUM']);
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
            case 'count':
                $column_key = 'COUNT(*) AS NUM ';
                break;

            default:
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
    public function update($table, $values, $where, $where_value = [])
    {
        list($prepared_statement, $values) = $this->getPreparedStatement('update', $values);

        $sql = " UPDATE "
            .    $table
            . " SET "
            .    $prepared_statement
            . " WHERE "
            .    $where
            ;
        $update_data = array_merge($values, $where_value);
        $stmt       = $this->pdo->prepare($sql);
        $bool = $stmt->execute($update_data);
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
