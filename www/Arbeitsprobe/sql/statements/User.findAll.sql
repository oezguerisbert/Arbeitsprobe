SELECT
    *
FROM
    users
WHERE id >= :page
LIMIT :limit;