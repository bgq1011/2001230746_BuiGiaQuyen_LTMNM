-- Bai 3: Liet ke danh muc co tren 5 san pham.
SELECT c.category_name, COUNT(p.product_id) AS total_products
FROM categories c
-- JOIN thuong chi lay cac danh muc co it nhat 1 san pham.
JOIN products p ON c.category_id = p.category_id
GROUP BY c.category_name
-- Loc sau khi gom nhom de chi giu lai nhom co so luong > 5.
HAVING COUNT(p.product_id) > 5;
