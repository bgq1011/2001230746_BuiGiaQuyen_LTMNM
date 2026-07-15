-- Bai 7: Tim khach hang mua nhieu san pham nhat (theo tong so luong).
SELECT c.customer_id, c.name, SUM(od.quantity) AS total_items
FROM customers c
JOIN orders o ON c.customer_id = o.customer_id
JOIN order_details od ON o.order_id = od.order_id
GROUP BY c.customer_id, c.name
-- Sap xep giam dan de dua khach mua nhieu nhat len dau.
ORDER BY total_items DESC
LIMIT 1;