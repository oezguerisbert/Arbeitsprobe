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