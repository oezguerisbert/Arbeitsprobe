DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(200) NOT NULL UNIQUE,
  `vorname` VARCHAR(200) NOT NULL,
  `nachname` VARCHAR(200) NOT NULL,
  `email` VARCHAR(200) NOT NULL UNIQUE,
  `password` VARCHAR(200) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usertype` ENUM('user', 'moderator', 'admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET = utf8mb4;

INSERT INTO
  `users`(
    `username`,
    `vorname`,
    `nachname`,
    `email`,
    `password`,
    `phone`,
    `usertype`
  ) VALUE(
    "admin",
    "admin",
    "admin",
    "admin@localhost",
    "8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918",
    "00000000000000",
    "admin"
  );
DROP TABLE IF EXISTS `kxi_services`;
CREATE TABLE IF NOT EXISTS kxi_services (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(200) NOT NULL,
  `price` DECIMAL(20, 2) NOT NULL,
  `image` VARCHAR(200) NOT NULL DEFAULT "https://images.unsplash.com/photo-1519049069275-dea996e1a314?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=375&q=80",
  `kuerzel` VARCHAR(200) NOT NULL,
  `description` VARCHAR(200),
  PRIMARY KEY (`id`)
);

INSERT INTO
  kxi_services(`kuerzel`, `title`, `price`, `description`)
VALUES
  (
    "allround",
    "Allround-Skis",
    50.00,
    "Unsere Allround-Skis für jeden."
  ),
  (
    "slalom",
    "Slalom-Skis",
    70.00,
    "Diese Skis sind perfekt fürs Slalom fahren!"
  ),
  (
    "amc",
    "All-Mountain-Carving",
    150.00,
    "Diese Skis sind für fortgeschrittene Leute gedacht, viel Spaß!"
  ),
  (
    "freeride",
    "Freeride-Skis",
    35.00,
    "Free Ride Skis sind für Profi-Ski fahrer ☺"
  ),
  (
    "goofy",
    "Goofy-Snowboard",
    90.00,
    "Ein Goofy Snowboard für chillige snowboard Aktivitäten!"
  ),
  (
    "regular",
    "Regular-Snowboard",
    50.00,
    "Reguläre Snowboards für jederman/-frau 🤩"
  );
DROP TABLE IF EXISTS `kxi_priorities`;
CREATE TABLE IF NOT EXISTS `kxi_priorities` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `kuerzel` VARCHAR(200) NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `color` VARCHAR(200) NOT NULL,
  `days` DECIMAL NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO
  `kxi_priorities`(`kuerzel`, `title`, `days`, `color`)
VALUES
  ("standart", "Standart", 7, "#fff9e3"),
  ("tief", "Tief", 12, "#eff8ff"),
  ("express", "Express", 5, "#fdbdbe");
  
DROP TABLE IF EXISTS `kxi_auftrag_modus`;
CREATE TABLE IF NOT EXISTS `kxi_auftrag_modus` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(200) NOT NULL,
    `description` VARCHAR(200) NOT NULL,
    `kuerzel` VARCHAR(10) NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO
    `kxi_auftrag_modus`(`name`, `description`, `kuerzel`)
VALUES
    ("neu", "Neu eingegangener Auftrag", "n"),
    ("bearbeitung", "Auftrag ist in Bearbeitung", "e"),
    ("abggelehnt", "Auftrag wurde abgelehnt", "c"),
    ("erledigt", "Auftrag wurde erledigt", "f"),
    ("hidden", "Auftrag wurde versteckt", "h");
    
CREATE TABLE IF NOT EXISTS `kxi_user_cart` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `userid` INT NOT NULL,
    `createdDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `isActive` TINYINT NOT NULL DEFAULT 1,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_user_cart_user` FOREIGN KEY (`userid`) REFERENCES `users`(`id`) ON DELETE NO ACTION
) DEFAULT CHARACTER SET = utf8mb4;

    CREATE TABLE IF NOT EXISTS `kxi_cartitem` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `firstname` VARCHAR(200) NOT NULL,
    `lastname` VARCHAR(200) NOT NULL,
    `serviceid` INT NULL,
    `gender` ENUM('male', 'female', 'other') NOT NULL,
    `height` INT NOT NULL,
    `birthdate` DATE NOT NULL,
    `cartid` INT NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_cartitem_service_id` FOREIGN KEY (`serviceid`) REFERENCES `kxi_services`(`id`) ON DELETE NO ACTION,
    CONSTRAINT `fk_cartitem_cart_id` FOREIGN KEY (`cartid`) REFERENCES `kxi_user_cart`(`id`) ON DELETE NO ACTION
) DEFAULT CHARACTER SET = utf8mb4;



CREATE TABLE IF NOT EXISTS `kxi_auftraege` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `prioid` INT NOT NULL,
    `cartid` INT NOT NULL,
    `request_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `moderatorid` INT,
    `visible` BOOLEAN NOT NULL DEFAULT TRUE,
    `modeid` INT DEFAULT 1,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_auftraeg_cart` FOREIGN KEY (`cartid`) REFERENCES `kxi_user_cart`(`id`) ON DELETE NO ACTION,
    CONSTRAINT `fk_auftraeg_prio` FOREIGN KEY (`prioid`) REFERENCES `kxi_priorities`(`id`) ON DELETE NO ACTION,
        CONSTRAINT `fk_auftrag_mode` FOREIGN KEY (`modeid`) REFERENCES `kxi_auftrag_modus`(`id`) ON DELETE NO ACTION
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