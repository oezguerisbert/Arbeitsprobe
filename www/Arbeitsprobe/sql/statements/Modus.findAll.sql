SELECT
    *
FROM
    kxi_auftrag_modus
WHERE id >= :page

LIMIT :limit;