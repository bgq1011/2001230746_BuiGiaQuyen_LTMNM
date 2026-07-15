-- Bai 1: Dem so luong san pham trong tung danh muc (ke ca danh muc chua co san pham).
SELECT c.category_name, COUNT(p.product_id) AS total_products
FROM categories c
-- LEFT JOIN de giu lai tat ca danh muc, ngay ca khi khong co ban ghi ben products.
LEFT JOIN products p ON c.category_id = p.category_id
GROUP BY c.category_name;