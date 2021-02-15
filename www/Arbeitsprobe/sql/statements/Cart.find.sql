SELECT * 
FROM kxi_user_cart 
WHERE id = :id
AND isActive = 1
LIMIT 1;