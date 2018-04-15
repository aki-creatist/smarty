<?php
class PreMember extends Database
{
    const TABLE_PRE = "premembers";
    const TABLE = "members";
    // 仮会員登録処理
    public function createPreMember($user)
    {
        $ins_data = $this->getInsData($user);
        $this->insert(self::TABLE_PRE, $ins_data);
    }

    // 登録確認のリンクをクリックしてアクセスしたときの処理
    public function getPreMember($username, $link_pass)
    {
        $where = "username =" . $this->quote($username);
        $where .= " AND link_pass =" . $this->quote($link_pass);
        $data = $this->first(self::TABLE_PRE, $where);
        return $data;
    }

    // 仮登録会員の削除と本登録
    public function deletePreAndRegist($user)
    {
        $Members = new Members();
        $MemberTraffic = new MemberTraffic();
        $MemberPostcode = new MemberPostcode();
        $id = htmlspecialchars($user['id']);
        $link_pass = htmlspecialchars($user['link_pass']);
        $where = "id =" . $this->quote($id);
        $where .= " AND link_pass =" . $this->quote($link_pass);
        $postcode['zip1'] = substr($user['zip'], 0, 3);
        $postcode['zip2'] = substr($user['zip'], 3, 4);
        $postcode['address'] = $user['address'];
        $traffic_id = explode('_', $user['traffic']);
        unset($user['id']);
        unset($user['link_pass']);
        unset($user['zip']);
        unset($user['address']);
        unset($user['traffic']);
        try {
            $this->pdo->beginTransaction();
            $Members->createMemberFromPreMember($user);
            $id = $this->selectMax(self::TABLE, 'id');
//            var_dump($id);exit;
            $MemberPostcode->createMemberPostcode($postcode, $id);
            $MemberTraffic->createMemberTraffic($traffic_id, $id);
            $this->delete(self::TABLE_PRE, $where);
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();exit;
        }
    }

    private function getInsData($user)
    {
        $year     = $user['year'];
        $month    = $user['month'];
        $day      = $user['day'];
        $zip1     = $user['zip1'];
        $zip2     = $user['zip2'];
        $tel1     = $user['tel1'];
        $tel2     = $user['tel2'];
        $tel3     = $user['tel3'];
        $traffics = $user['traffic'];
        $user['birthday'] = $year . $month . $day;
        $user['zip'] = $zip1 . $zip2;
        $user['tel'] = $tel1 . $tel2 . $tel3;
        $user['traffic'] = implode('_', $traffics);
        unset($user['year']);
        unset($user['month']);
        unset($user['day']);
        unset($user['zip1']);
        unset($user['zip2']);
        unset($user['tel1']);
        unset($user['tel2']);
        unset($user['tel3']);
        $ins_data = $user;
        return $ins_data;
    }
}