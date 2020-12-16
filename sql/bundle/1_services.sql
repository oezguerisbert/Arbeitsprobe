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
    "klein",
    "Kleiner Service",
    50.00,
    "Unser kleiner Service beinhaltet die einfachen Einstellungen"
  ),
  (
    "gross",
    "Grosser Service",
    70.00,
    "Unser grosser Service beinhaltet alle Einstellungen"
  ),
  (
    "rennski",
    "Rennski-Service",
    150.00,
    "Das Komplettpacket"
  ),
  (
    "montage",
    "Bindung montieren und einstellen",
    20.00,
    "Eine sehr gute Montage des Equipments"
  ),
  (
    "fell",
    "Fell zuschneiden",
    15.00,
    "Das zuschneiden des Fells für das perfekte Feeling"
  ),
  (
    "wachs",
    "Heisswachsen",
    15.00,
    "Mit hochprofessionellem Wachs wird ihr Equipment versorgt"
  );