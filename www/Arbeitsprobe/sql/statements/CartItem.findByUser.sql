SELECT
    *
FROM
    kxi_cartitem kxici
    LEFT JOIN kxi_user_cart kxiuc ON kxiuc.id = kxici.cartid
WHERE
    kxiuc.userid = :userid
    AND kxiuc.`isActive` = 1;