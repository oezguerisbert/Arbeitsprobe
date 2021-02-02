CREATE TABLE IF NOT EXISTS `kxi_cart` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `userid` INT NOT NULL,
    `serviceid` INT NULL,
    `prioid` INT NULL,
    `gender` ENUM('male', 'female', 'other') NOT NULL,
    `height` INT NOT NULL,
    `birthdate` DATE NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_cart_user_id` FOREIGN KEY (`userid`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_cart_service_id` FOREIGN KEY (`serviceid`) REFERENCES `kxi_services`(`id`) ON DELETE
    SET
        NULL,
        CONSTRAINT `fk_cart_prio_id` FOREIGN KEY (`prioid`) REFERENCES `kxi_priorities`(`id`) ON DELETE
    SET
        NULL
) DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE IF NOT EXISTS `kxi_user_cart` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `userid` INT NOT NULL,
    `cartid` INT NOT NULL,
    `isActive` TINYINT NOT NULL DEFAULT 1,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_user_cart_user_id` FOREIGN KEY (`userid`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_user_cart_cart_id` FOREIGN KEY (`cartid`) REFERENCES `kxi_cart`(`id`) ON DELETE NO ACTION
) DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE IF NOT EXISTS `kxi_auftraege` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `prioid` INT,
    `serviceid` INT,
    `request_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `userid` INT NOT NULL,
    `moderatorid` INT,
    `visible` BOOLEAN NOT NULL DEFAULT TRUE,
    `modeid` INT DEFAULT 1,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_user_id` FOREIGN KEY (`userid`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_prio_id` FOREIGN KEY (`prioid`) REFERENCES `kxi_priorities`(`id`) ON DELETE
    SET
        NULL,
        CONSTRAINT `fk_auftrag_service_id` FOREIGN KEY (`serviceid`) REFERENCES `kxi_services`(`id`) ON DELETE
    SET
        NULL,
        CONSTRAINT `fk_auftrag_mode_id` FOREIGN KEY (`modeid`) REFERENCES `kxi_auftrag_modus`(`id`) ON DELETE
    SET
        NULL
) DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE IF NOT EXISTS `kxi_auftrag_kommentare` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `userid` INT NOT NULL,
    `auftragid` INT NOT NULL,
    `content` LONGTEXT NOT NULL,
    `addedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_comment_auftrag_id` FOREIGN KEY (`auftragid`) REFERENCES `kxi_auftraege`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_comment_user_id` FOREIGN KEY (`userid`) REFERENCES `users`(`id`) ON DELETE CASCADE
);