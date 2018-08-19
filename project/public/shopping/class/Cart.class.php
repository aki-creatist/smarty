<?php
class Cart
{
    private $db = NULL;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // カートに登録する(必要な情報はだれが$customer_no 、何を($item_id))
    public function insCartData($customer_no, $item_id)
    {
        $table   = 'carts';
        $insData = ['customer_no' => $customer_no, 'item_id' =>$item_id];
        return $this->db->insert($table, $insData);
    }

    // カートの情報を取得する(必要な情報はだれが$customer_no
    // 必要な商品情報は名前、商品画像、金額
    public function getCartData($customer_no)
    {
        $table  = 'carts c LEFT JOIN items i ON c.item_id = i.id';
        $column = 'c.id as cart_id, i.id, i.name, i.price, i.image, c.delete_flg';
        $where  = 'c.customer_no =? AND c.delete_flg = ?';
        $where_value = [$customer_no , 0];

        return $this->db->select($table, $column, $where, $where_value);
    }

    // カート情報を削除する(必要な情報はどのカートを($crt_id)
    public function delCartData( $crt_id )
    {
        $table = 'carts';
        $update_data = ['delete_flg'=> 1];
        $where = 'id=?';
        $where_value = [$crt_id];

        return $this->db->update($table, $update_data, $where, $where_value);
    }

    // アイテム数と合計金額を取得する
    public function getItemAndSumPrice($customer_no)
    {
        // 合計金額
        $table  = " carts c  LEFT JOIN items i  ON c.item_id = i.id ";
        $column = " SUM( i.price ) AS totalPrice ";
        $where  = 'c.customer_no = ? AND c.delete_flg = ?';
        $where_value = [$customer_no, 0];

        $res = $this->db->select($table, $column, $where, $where_value);

        $price = $res !== false && count($res) !== 0 ? $res[0]['totalPrice'] : 0;

        // アイテム数
        $table = ' carts c ';
        $column = ' SUM( num ) AS num ';
        $res = $this->db->select($table, $column, $where, $where_value);

        $num = $res !== false && count($res) !== 0 ? $res[0]['num'] : 0;
        return [$num, $price];
    }
}
