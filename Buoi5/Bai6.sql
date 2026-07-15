-- Bai 6: Tim cac san pham chua tung xuat hien trong bat ky chi tiet don hang nao.
SELECT p.product_id, p.name
FROM products p
LEFT JOIN order_details od ON p.product_id = od.product_id
-- Neu khong co ban ghi phu hop ben order_details thi od.product_id se la NULL.
WHERE od.product_id IS NULL;