SELECT * 
FROM kxi_user_cart
WHERE userid = :userid
AND isActive = 1
LIMIT 1;