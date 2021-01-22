SELECT
    *
FROM
    kxi_priorities
WHERE id >= :id
LIMIT :limit;