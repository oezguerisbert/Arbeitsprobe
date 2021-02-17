SELECT
    *
FROM
    kxi_services
WHERE id >= :page
LIMIT :limit;