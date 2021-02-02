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