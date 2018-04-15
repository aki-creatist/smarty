<?php

class Systems extends Database
{
    const TABLE = 'system';
    const TABLE_MEMBERS = 'members';

    public function selectTest()
    {
        $data = $this->select(self::TABLE);
        return $data;
    }

    /**
     * 管理者情報をユーザー名で検索
     * @param $username
     * @return mixed
     */
    public function getAdmin($username)
    {
        $where = 'username=' . "'" . $username . "'";
        $admin = $this->first(self::TABLE, $where);
        return $admin;
    }

    public function getList($search_key)
    {
        $where = '';
        if ($search_key !== '') {
            $search_key = "'%" . $search_key . "%'";
            $where = 'last_name like '
                . $search_key
                . ' OR '
                . 'first_name like '
                . $search_key;
        }
        /*
         SELECT
             M.id,
             M.last_name,
             M.first_name,
             M.birthday,
             P.pref,
             M.created_at
         FROM members M
         LEFT JOIN member_postcode MP
         ON MP.member_id = M.id
         LEFT JOIN postcode P
         ON P.id = MP.postcode_id
         \G
         */
        $table = self::TABLE_MEMBERS . ' M';
        $table .= ' LEFT JOIN member_postcode MP';
        $table .= ' ON MP.member_id = M.id';
        $table .= ' LEFT JOIN postcode P';
        $table .= ' ON P.id = MP.postcode_id';
        $column = 'M.id,';
        $column .= ' M.last_name,';
        $column .= ' M.first_name,';
        $column .= ' M.birthday,';
        $column .= ' P.pref,';
        $column .= ' M.created_at,';
        $column .= ' M.updated_at';
        $this->setOrder('id ASC');
        $data = $this->select($table, $column, $where);
        $count = $this->count(self::TABLE_MEMBERS, $where);
        foreach ($data as $key => $val) {
            $birthday = $val['birthday'];
            $data[$key]['year'] = substr($birthday, 0, 4);
            $data[$key]['month'] = substr($birthday, 4, 2);
            $data[$key]['day'] = substr($birthday, 6, 2);
            unset($data[$key]['birthday']);
        }
        return [$data, $count];
    }

    // 更新画面と詳細画面で使用
    public function getDetail($id)
    {
        $where = 'id=' . (int)$id;
        $detail = $this->first(self::TABLE_MEMBERS, $where);
        $birthday = $detail['birthday'];
        $tel = $detail['tel'];
        $detail['year'] = substr($birthday, 0, 4);
        $detail['month'] = substr($birthday, 4, 2);
        $detail['day'] = substr($birthday, 6, 2);
        $detail['tel1'] = substr($tel, 0, 3);
        $detail['tel2'] = substr($tel, 3, 4);
        $detail['tel3'] = substr($tel, 4, 4);
        return $detail;
    }
}