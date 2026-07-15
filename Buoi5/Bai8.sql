-- Bai 8: Thong ke tong so luong va doanh thu theo tung loai san pham (ban don gian).
SELECT c.category_id,
	   c.category_name,
	   SUM(od.quantity) AS total_quantity,
	   SUM(od.quantity * od.price) AS total_revenue
FROM order_details od
JOIN products p ON od.product_id = p.product_id
JOIN categories c ON p.category_id = c.category_id
GROUP BY c.category_id, c.category_name;
