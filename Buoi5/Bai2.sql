-- Bai 2: Tinh tong doanh thu theo ngay dat hang.
SELECT o.order_date, SUM(od.quantity * od.price) AS total_revenue
FROM orders o
-- Noi don hang voi chi tiet don hang de lay so luong va gia tai thoi diem mua.
JOIN order_details od ON o.order_id = od.order_id
GROUP BY o.order_date;
