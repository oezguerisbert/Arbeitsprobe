SELECT
    *
FROM
    kxi_auftraege
WHERE
    visible = 1
AND id >= :page
ORDER BY
    prioid DESC
LIMIT :limit;