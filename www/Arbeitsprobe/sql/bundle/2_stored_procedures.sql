DROP PROCEDURE IF EXISTS `findAuftrag`;
CREATE PROCEDURE  `findAuftrag`(
    in p_id INT 
)
BEGIN
    SELECT
        *
    FROM
        kxi_auftraege
    WHERE
        id = p_id;
END;

DROP PROCEDURE IF EXISTS `findAllAuftrag`;
CREATE PROCEDURE `findAllAuftrag`(
    in p_page INT,
    in p_limit INT
)
BEGIN
    SELECT
        *
    FROM
        kxi_auftraege
    WHERE
        visible = 1
    AND
        id >= p_page
    ORDER BY
        prioid DESC
    LIMIT p_limit;
END;

DROP PROCEDURE IF EXISTS `findCart`;
CREATE PROCEDURE `findCart`(
    in p_id INT
)
BEGIN
    SELECT 
        * 
    FROM 
        kxi_user_cart 
    WHERE
        id = p_id
    AND 
        isActive = 1
    LIMIT 1;
END;

DROP PROCEDURE IF EXISTS `findAllCart`;
CREATE PROCEDURE `findAllCart`(
    in p_page INT,
    in p_limit INT
)
BEGIN
    SELECT * 
    FROM 
    kxi_user_cart
    WHERE 
        id >= p_page
    LIMIT p_limit;
END;


DROP PROCEDURE IF EXISTS `findCartItem`;
CREATE PROCEDURE `findCartItem`(
    in p_id INT
)
BEGIN
    SELECT
        *
    FROM
        kxi_cartitem
    WHERE
        id = p_id;
END;

DROP PROCEDURE IF EXISTS `findAllCartItem`;
CREATE PROCEDURE `findAllCartItem`(
    in p_page INT,
    in p_limit INT
)
BEGIN
    SELECT
        *
    FROM
        kxi_cartitem
    WHERE 
        id >= p_page
    LIMIT p_limit;
END;

DROP PROCEDURE IF EXISTS `findModus`;
CREATE PROCEDURE `findModus`(
    in p_id INT
)
BEGIN
    SELECT
        *
    FROM
        kxi_auftrag_modus
    WHERE
        id = p_id;
END;

DROP PROCEDURE IF EXISTS `findAllModus`;
CREATE PROCEDURE `findAllModus`(
    in p_page INT,
    in p_limit INT
)
BEGIN
    SELECT
        *
    FROM
        kxi_auftrag_modus
    WHERE id >= p_page

    LIMIT p_limit;
END;

DROP PROCEDURE IF EXISTS `findPriority`;
CREATE PROCEDURE `findPriority`(
    in p_id INT
)
BEGIN
    SELECT 
        *
    FROM
        kxi_priorities
    WHERE id = p_id;
END;

DROP PROCEDURE IF EXISTS `findAllPriority`;
CREATE PROCEDURE `findAllPriority`(
    in p_page INT,
    in p_limit INT
)
BEGIN
    SELECT
        *
    FROM
        kxi_priorities
    WHERE id >= p_page
    LIMIT p_limit;
END;

DROP PROCEDURE IF EXISTS `findService`;
CREATE PROCEDURE `findService`(
    in p_id INT
)
BEGIN
    SELECT
        *
    FROM
        kxi_services
    WHERE
        id = p_id
    LIMIT 1;
END;

DROP PROCEDURE IF EXISTS `findAllService`;
CREATE PROCEDURE `findAllService`(
    in p_page INT,
    in p_limit INT
)
BEGIN
    SELECT
        *
    FROM
        kxi_services
    WHERE id >= p_page
    LIMIT p_limit;
END;

DROP PROCEDURE IF EXISTS `findUser`;
CREATE PROCEDURE `findUser`(
    in p_id INT
)
BEGIN
    SELECT
        *
    FROM
        users
    WHERE
        id = p_id
    LIMIT 1;
END;

DROP PROCEDURE IF EXISTS `findAllUser`;
CREATE PROCEDURE `findAllUser`(
    in p_page INT,
    in p_limit INT
)
BEGIN
    SELECT
        *
    FROM
        users
    WHERE id >= p_page
    LIMIT p_limit;
END;
