START TRANSACTION;
    UPDATE kxi_cartitem
        SET `firstname` = :firstname,
        `lastname` = :lastname,
        `serviceid` = :serviceid,
        `gender` = :gender,
        `height` = :height,
        `birthdate` = :birthdate
        WHERE id = :id;
COMMIT;