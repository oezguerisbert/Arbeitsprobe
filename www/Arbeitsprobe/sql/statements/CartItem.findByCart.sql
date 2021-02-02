SELECT
    *
FROM
    kxi_cart
    LEFT JOIN kxi_user_cart ON cartid = :cartid
WHERE
    userid = :userid
    AND isActive = 1;