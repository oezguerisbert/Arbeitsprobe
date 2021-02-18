SELECT * 
FROM kxi_user_cart
WHERE id >= :page
LIMIT :limit;