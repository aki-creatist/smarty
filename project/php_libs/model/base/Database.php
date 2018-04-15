<?php
class Database extends BaseModel
{
    protected $pdo;
    private  $order   = '';
    private  $limit   = '';
    private  $offset  = '';
    private  $groupby = '';

    public function getDbh()
    {
        return $this->pdo;
    }

    public function quote($where)
    {
        return $this->pdo->quote($where);
    }

    public function select($table, $column = '', $where = '')
    {
        $sql = $this->getSql('select', $table, $where, $column);

        $stmt = $this->pdo->query($sql);
        $data = [];
        foreach ($stmt as $key => $value) {
            array_push($data, $value);
        }
        return $data;
    }

    public function first($table, $where = '')
    {
        $sql = $this->getSql('select', $table, $where);
        $sql .= "limit 1 ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetch();
        return $data;
    }

    public function count($table, $where = '')
    {
        $sql = $this->getSql('select', $table, $where);
        $stmt = $this->pdo->query($sql);
        return $stmt->rowCount();
    }

    public function selectMax($table, $column, $where = '')
    {
        $column = 'MAX(' . $column . ')';
        $data = $this->select($table, $column, $where);
        $data = $data[0][$column];
        return $data;
    }

    public function setOrder($order = '')
    {
        if ($order !== '') $this->order = ' ORDER BY ' . $order;
    }

    public function setLimitOff($limit = '', $offset = '')
    {
        if ($limit !== "") $this->limit = " LIMIT " . $limit;
        if ($offset !== "") $this->offset = " OFFSET " . $offset;
    }

    public function setGroupBy($groupby)
    {
        if ($groupby !== "") $this->groupby = ' GROUP BY ' . $groupby;
    }

    private function getSql($type, $table, $where = '', $column = '')
    {
        switch ($type) {
            case 'select':
                $column_key = ($column !=='') ? $column : "*";
                break;
            case 'count':
                $column_key = 'COUNT(*) AS num ';
                break;
            default:
                break;
        }
        $where_sql = ($where !== '') ? ' WHERE  ' . $where : '';
        $other = $this->groupby . " " . $this->order . " " . $this->limit . " " . $this->offset;
        $sql = " SELECT "
            .    $column_key
            ." FROM "
            .    $table
            .    $where_sql
            .    $other
        ;
        return $sql;
    }

    public function execute($query = '', $values = [])
    {
        $stmt = $this->pdo->prepare($query);
        $bool = $stmt->execute($values);
        return $bool;
    }

    public function insert($table, $ins_data = [], $geo = '')
    {
        list($pre_st, $ins_data_val, $columns) = $this->getPreparedStatement('insert', $ins_data, $table, $geo);
        $sql = " INSERT INTO " . $table . " ("
            .    $columns
            . ") VALUES ("
            .    $pre_st
            . ") "
        ;

        $bool = $this->execute($sql, $ins_data_val);
        return $bool;
    }

    public function update($table, $ins_data = [], $where, $values = [])
    {
        list($pre_st, $ins_data_val) = $this->getPreparedStatement('update', $ins_data, $table);
        $sql = " UPDATE "
            .    $table
            . " SET "
            .    $pre_st
            . " WHERE "
            .    $where
        ;
        $update_data = array_merge($ins_data_val, $values);
        $bool = $this->execute($sql, $update_data);
        return $bool;
    }

    public function getColumn($table)
    {
        $this->setLimitOff(0);
        $sql = $this->getSql('select', $table);
        $stmt = $this->pdo->query($sql);
        $columns = [];
        for ($i = 0; $i < $stmt->columnCount(); $i++) {
            $meta = $stmt->getColumnMeta($i);
            $columns[] = $meta['name'];
        }
        $this->limit = '';
        return $columns;
    }

    public function delete($table, $where = '')
    {
        $sql = " DELETE FROM "
            . $table
            . " where "
            . $where
        ;
        $bool = $this->execute($sql);
        if (!$bool) {
            return false;
        }
    }

    public function create($table, $sql)
    {
        $sql = "CREATE TABLE IF NOT EXISTS "
            .$table
            ."("
            .$sql
        ;
        $bool = $this->execute($sql);
        return $bool;
    }

    public function getPreparedStatement($mode, $ins_data, $table, $geo = '')
    {
        if ($ins_data !== null) {
            $ins_data_key = array_keys($ins_data);
            $ins_data_val = array_values($ins_data);
            $pre_count    = count($ins_data_key);
            switch($mode) {
                case 'insert':
                    $columns  = implode(",", $ins_data_key);
                    $pre_st = array_fill(0, $pre_count, '?');
                    if (TYPE === 'mysql') {
                        if (in_array($geo, $ins_data_key)) {
                            for ($i = 0; $i < count($ins_data_key); $i++) {
                                if ($ins_data_key[$i] === $geo) {
                                    $pre_st[$i] = "GeomFromText(?)";
                                }
                            }
                        }
                    }
                    $pre_st    = implode(",", $pre_st);
                    return [$pre_st, $ins_data_val, $columns];
                    break;
                case 'update':
                    for($i = 0; $i < $pre_count; $i++) {
                        $pre_st[$i] = $ins_data_key[$i] . " =? ";
                    }
                    $pre_st = implode(",", $pre_st);
                    return [$pre_st, $ins_data_val];
                    break;
            }
        } else {
            return false;
        }
    }
}
