<?php

class Members extends Database
{
    const TABLE = 'members';

    public function selectTest()
    {
        $data = $this->select(self::TABLE);
        return $data;
    }

    /**
     * 管理者画面からの即時登録
     * @param $user
     */
    public function createUser($user)
    {
        $ins_data = $this->getInsData($user);

        $this->insert(self::TABLE, $ins_data);
        return $id = $this->selectMax(self::TABLE, 'id');
    }
    /**
     * 管理者画面からの即時登録
     */
    public function createMemberFromSystem($user)
    {
        $traffic_id = $user['traffic'];

        $MemberTraffic = new MemberTraffic();
        $MemberPostcode = new MemberPostcode();

        $id = $this->createUser($user);
        $MemberPostcode->createMemberPostcode($user, $id);
        $MemberTraffic->createMemberTraffic($traffic_id, $id);
    }
    /**
     * 一般会員登録用の仮会員登録 - 仮登録モデルから呼び出す
     */
    public function createMemberFromPreMember($user)
    {
        $this->insert(self::TABLE, $user);
    }

    public function updateUser($id, $user)
    {
        unset($user['submit']);
        unset($user['mode']);
        unset($user['action']);
        $ins_data = $this->getInsData($user);
        $where = 'id=' . "'" . $id . "'";
        $this->update(self::TABLE, $ins_data, $where);
    }

    public function deleteUser($id)
    {
        $where = 'id=' . (int)$id;
        $this->delete(self::TABLE, $where);
    }

    // 更新画面と詳細画面で使用
    public function getDetail($id)
    {
        $where = 'id=' . (int)$id;
        $detail = $this->first(self::TABLE, $where);
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

    // TODO:: PreMemberModel.phpにも同様の処理あるから共通化
    private function getInsData($user)
    {
        $year = $user['year'];
        $month = $user['month'];
        $day = $user['day'];
        $tel1 = $user['tel1'];
        $tel2 = $user['tel2'];
        $tel3 = $user['tel3'];
        $user['birthday'] = $year . $month . $day;
        $user['tel'] = $tel1 . $tel2 . $tel3;
        unset($user['year']);
        unset($user['month']);
        unset($user['day']);
        unset($user['zip1']);
        unset($user['zip2']);
        unset($user['address']);
        unset($user['tel1']);
        unset($user['tel2']);
        unset($user['tel3']);
        unset($user['traffic']);
        $ins_data = $user;
        return $ins_data;
    }
}