-- Bai 12: Liet ke tat ca san pham va so lan duoc dat hang (neu chua dat thi la 0).
SELECT p.product_id,
	   p.name,
	   COUNT(od.order_id) AS order_count
FROM products p
LEFT JOIN order_details od ON p.product_id = od.product_id
GROUP BY p.product_id, p.name;
