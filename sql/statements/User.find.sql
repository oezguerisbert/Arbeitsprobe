SELECT
    *
FROM
    users
where
    id = :id
LIMIT
    1;