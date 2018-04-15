<?php
class MemberPostcode extends Database
{
    const TABLE_MEMBER = 'members';
    const TABLE_POSTCODE = 'postcode';
    const TABLE = 'member_postcode';
    public function getMemberPostcode($member_id)
    {
        $where = 'member_id=' . "'" . $member_id . "'";
        $table = 'postcode P';
        $table .= ' LEFT JOIN member_postcode M';
        $table .= ' ON M.postcode_id = P.id';
        $postcode = $this->first($table, $where);
        var_dump($member_id);
        $zip = $postcode['zip'];

//        $pref = $postcode['pref'];
//        $city = $postcode['city'];
//        $town = $postcode['town'];
        $address = $postcode['address'];
        /*
         SELECT zip, pref, city, town FROM postcode P
         LEFT JOIN member_postcode M
         ON M.postcode_id = P.id
         WHERE M.member_id = 1
         limit 1;
         */
        $detail['zip1'] = substr($zip, 0, 3);
        $detail['zip2'] = substr($zip, 3, 4);
//        $detail['pref'] = $pref;
//        $detail['city'] = $city;
//        $detail['town'] = $town;
        $detail['address'] = $address;
//
//        return $detail;
        return [
            $detail['zip1'],
            $detail['zip2'],
            $address
        ];
    }
    /**
     * 中間テーブルにデータを挿入する
     */
    public function createMemberPostcode($user, $premembers_id)
    {
        $zip = $user['zip1'] . $user['zip2'];
        $postcode_id = $this->getPostcodeID($zip);
        $this->insertMemberPostcode($premembers_id, $postcode_id, $user['address']);
    }

    /**
     * 挿入処理
     */
    public function insertMemberPostcode($member_id, $postcode_id, $address)
    {
        $insert_data = [
            'member_id' => $member_id,
            'postcode_id' => $postcode_id,
            'address' => $address
        ];
        $this->insert(self::TABLE, $insert_data);
    }
    public function updateMemberPostcode($member_id, $user)
    {
        $zip = $user['zip1'] . $user['zip2'];
        $postcode_id = $this->getPostcodeID($zip);
        $is_member = $this->countParent($member_id);

        $is_zip = $this->countChild($zip);

        if ($is_member !== false && $is_zip !== false) {
            $ins_data = [
                'member_id' => $member_id,
                'postcode_id' => $postcode_id,
                'address' => $user['address']
            ];
            // 新規？or既存？
            $is_FK = $this->countFK($member_id);
            switch ($is_FK) {
                case false: // 新規
                    $this->insert(self::TABLE, $ins_data);
                    break;
                case true:  // 既存
                    $where = 'member_id=' . $member_id;
                    $this->update(self::TABLE, $ins_data, $where);
                    break;
            }
        }
    }
    public function deleteMemberPostcode($member_id)
    {
        $where = 'member_id IN (' . $member_id . ')';
        $this->delete(self::TABLE, $where);
    }
    public function getPostcodeID($postcode)
    {
        $where = 'zip=' . "'" . $postcode . "'";
        $postcode_id = $this->first('postcode', $where);
        return $postcode_id['id'];
    }
    private function countParent($member_id)
    {
        $where = 'id=' . $member_id;
        $is_member = $this->count(self::TABLE_MEMBER, $where);

        $is_member = $is_member > 0 ? true : false;
        return $is_member;
    }
    private function countChild($zip)
    {
        $where = 'zip=' . $zip;
        $is_zip = $this->count(self::TABLE_POSTCODE, $where);
        $is_zip = $is_zip > 0 ? true : false;
        return $is_zip;
    }
    private function countFK($member_id)
    {
        $where = 'member_id=' . $member_id;
        $is_FK = $this->count(self::TABLE, $where);
        $is_FK = $is_FK > 0 ? true : false;
        return $is_FK;
    }
}