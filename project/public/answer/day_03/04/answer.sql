-- 4-1 テーブルの連結
SELECT
    cus.customer_name  ,
    ord.order_id ,
    pro.product_name ,
    pro.price,
    detail.product_count ,
    pro.price * detail.product_count AS total
FROM
    customer_tb cus
JOIN
    order_tb ord
ON
    cus.customer_id = ord.customer_id
JOIN
    order_detail_tb detail
ON
    ord.order_id = detail.order_id
JOIN
    product_tb pro
on
    detail.product_id = pro.product_id
ORDER BY
    cus.customer_id desc;

-- 4-2 顧客別売上リスト
SELECT
    cus.customer_name  ,
    SUM( pro.price * detail.product_count  ) AS sales
FROM
    customer_tb cus
JOIN
    order_tb ord
ON
    cus.customer_id = ord.customer_id
JOIN
    order_detail_tb detail
ON
    ord.order_id = detail.order_id
JOIN
    product_tb pro
ON
   detail.product_id = pro.product_id
GROUP BY
 cus.customer_id
ORDER BY
 sales desc;