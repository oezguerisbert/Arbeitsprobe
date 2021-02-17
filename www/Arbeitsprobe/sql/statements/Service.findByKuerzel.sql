SELECT
    *
FROM
    kxi_services
WHERE
    kuerzel = :kuerzel
LIMIT
    1;