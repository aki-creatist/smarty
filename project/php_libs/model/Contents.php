<?php

class Contents extends Database
{
    const TABLE = 'contents';

    public function selectTest()
    {
        $data = $this->select(self::TABLE);
        return $data;
    }

    public function insertData($ins_data)
    {
        try {
            // $ins_data['created_at'] = ' NOW() ';
            $ins_data['updated_at'] = date('Y-m-d H:i:s');
            $this->pdo->beginTransaction();
            $this->insert(self::TABLE, $ins_data);
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }
    // 一覧
    public function getList($search_key)
    {
        $where = '';
        if ($search_key !== '') {
            $search_key = "'%" . $search_key . "%'";
            $where = 'name like '
                . $search_key
                . ' OR '
                . 'contents like '
                . $search_key
            ;
        }
        $data = $this->select(self::TABLE, '', $where);
        $count = $this->count(self::TABLE, $where);
        return [$data, $count];
    }
    // 自作ページャを使用する際に有効化(Controller.indexで切り替え)
    public static function paginate($num = '')
    {
//        $Paginator = new Paginator();
//        return $Paginator->run(self::TABLE, $num);
    }
}