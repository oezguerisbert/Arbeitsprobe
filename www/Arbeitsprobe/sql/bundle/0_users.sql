DROP TABLE IF EXISTS `users`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(200) NOT NULL,
  `vorname` VARCHAR(200) NOT NULL,
  `nachname` VARCHAR(200) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
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