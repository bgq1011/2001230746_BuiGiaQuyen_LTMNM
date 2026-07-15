-- Bai 5: Lay san pham co gia cao nhat trong moi danh muc.
SELECT c.category_name, p.name, p.price
FROM products p
JOIN categories c ON p.category_id = c.category_id
WHERE p.price = (
	-- Truy van con tuong quan: tim gia lon nhat trong cung danh muc cua san pham p.
	SELECT MAX(p2.price)
	FROM products p2
	WHERE p2.category_id = p.category_id
);
