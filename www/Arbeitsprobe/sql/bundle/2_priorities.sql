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