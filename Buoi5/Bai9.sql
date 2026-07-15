-- Bai 9: Tim 3 san pham ban chay nhat theo tong so luong da ban.
SELECT p.product_id,
	   p.name,
	   SUM(od.quantity) AS total_sold
FROM products p
JOIN order_details od ON p.product_id = od.product_id
GROUP BY p.product_id, p.name
ORDER BY total_sold DESC
LIMIT 3;
