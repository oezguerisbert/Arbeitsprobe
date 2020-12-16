CREATE TABLE IF NOT EXISTS `kxi_auftraege` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `prioid` INT NOT NULL,
    `serviceid` INT NOT NULL,
    `request_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `userid` INT(11) NOT NULL,
    `visible` BOOLEAN NOT NULL DEFAULT TRUE,
    `modeid` INT NOT NULL DEFAULT 1,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_user_id` FOREIGN KEY (`userid`) REFERENCES `users`(`id`),
    CONSTRAINT `fk_prio_id` FOREIGN KEY (`prioid`) REFERENCES `kxi_priorities`(`id`),
    CONSTRAINT `fk_service_id` FOREIGN KEY (`serviceid`) REFERENCES `kxi_services`(`id`),
    CONSTRAINT `fk_mode_id` FOREIGN KEY (`modeid`) REFERENCES `kxi_auftrag_modus`(`id`)
) DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE IF NOT EXISTS `kxi_auftrag_kommentare` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `userid` INT NOT NULL,
    `auftragid` INT NOT NULL,
    `content` LONGTEXT NOT NULL,
    `addedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_comment_auftrag_id` FOREIGN KEY (`auftragid`) REFERENCES `kxi_auftraege`(`id`),
    CONSTRAINT `fk_comment_user_id` FOREIGN KEY (`userid`) REFERENCES `users`(`id`)
);