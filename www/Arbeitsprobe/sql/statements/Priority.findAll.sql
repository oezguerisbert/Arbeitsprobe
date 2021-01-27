SELECT
    *
FROM
    kxi_priorities
WHERE id >= :page
LIMIT :limit;