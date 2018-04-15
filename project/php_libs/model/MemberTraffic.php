<?php
class MemberTraffic extends Database
{
    const TABLE_MEMBERS = "members";
    const TABLE = 'member_traffics';

    /**
     * 中間テーブルにデータを挿入する
     */
    public function createMemberTraffic($traffic_ids, $premembers_id)
    {
        foreach ($traffic_ids as $traffic_id) {
            $is_traffic = $this->countChild($traffic_id);
            if ($is_traffic !== false) { // trafficsテーブルに該当IDが存在する場合
                $this->insertMemberTraffic($premembers_id, $traffic_id);
            } else {
                echo "member_idかtraffic_idのいずれかが存在していない";
            }
        }
    }

    /**
     * 挿入処理
     */
    public function insertMemberTraffic($member_id, $traffic_id)
    {
        $insert_data = [
            'member_id' => $member_id,
            'traffic_id' => $traffic_id
        ];
        $this->insert(self::TABLE, $insert_data);
    }

    public function updateMemberTraffic($id, array $user)
    {
        $member_id = $id;
        $p_traffic_id = isset($user['traffic']) ? $user['traffic'] : [];
        $is_member = $this->countParent($member_id);
        // select結果にあって、postにないものは削除
        // select結果にあって、postにあるものはそのまま
        // select結果になくて、postoにあるものはinsert
        $t_traffic_id = $this->getMemberTraffic($member_id);
        $count = $this->count('traffics');
        for ($i = 1; $i <= $count; $i++) {
            if (in_array($i, $p_traffic_id) && !in_array($i, $t_traffic_id)) {
                // insert
                $is_traffic = $this->countChild($i);
                if ($is_member !== false && $is_traffic !== false) {
                    $data = [
                        'member_id' => $member_id,
                        'traffic_id' => $i
                    ];
                    $this->insert(self::TABLE, $data);
                } else {
                    echo "false";
                }
            } elseif (!in_array($i, $p_traffic_id) && in_array($i, $t_traffic_id)) {
                // delete
                $where = 'member_id=' . $member_id . ' AND traffic_id=' . $i;
                $this->delete(self::TABLE, $where);
            }
        }
    }
    public function deleteMemberTraffic($member_id)
    {
        $where = 'member_id IN (' . $member_id . ')';
        $this->delete(self::TABLE, $where);
    }
    public function countParent($member_id)
    {
        $where = 'id=' . $member_id;
        $is_member = $this->count(self::TABLE_MEMBERS, $where);
        $is_member = $is_member > 0 ? true : false;
        return $is_member;
    }

    /**
     * traffcsテーブルに存在するIDか確認
     */
    public function countChild($traffic_id)
    {
        $where = 'id=' . $traffic_id;
        $is_traffic = $this->count('traffics', $where);
        $is_traffic = $is_traffic > 0 ? true : false;
        return $is_traffic;
    }
    public function getMemberTraffic($member_id)
    {
        $t_traffic_id = [];
        $column = 'traffic_id';
        $where = 'member_id IN (' . $member_id . ')';
        $selected = $this->select(self::TABLE, $column, $where);
        foreach ($selected as $val) {
            $t_traffic_id[] = $val['traffic_id'];
        }
        return $t_traffic_id;
    }
    // 詳細画面で使用
    public function getMemberTraffics($member_id)
    {
        $t_traffic_id = [];
        $column = 'MT.traffic_id,';
        $column .= ' T.name';
        $table = 'traffics T';
        $table .= ' LEFT JOIN member_traffics MT';
        $table .= ' ON MT.traffic_id = T.id';
        $where = 'member_id IN (' . $member_id . ')';
        $selected = $this->select($table, $column, $where);
        foreach ($selected as $val) {
            $t_traffic_id[$val['traffic_id']] = $val['name'];
        }
        return $t_traffic_id;
    }
}