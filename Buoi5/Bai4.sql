-- Bai 4: Tim khach hang co tong chi tieu lon hon 1,000,000.
SELECT c.customer_id, c.name, SUM(od.quantity * od.price) AS total_spent
FROM customers c
JOIN orders o ON c.customer_id = o.customer_id
JOIN order_details od ON o.order_id = od.order_id
GROUP BY c.customer_id, c.name
-- HAVING dung de loc tren gia tri tong hop sau GROUP BY.
HAVING total_spent > 1000000;