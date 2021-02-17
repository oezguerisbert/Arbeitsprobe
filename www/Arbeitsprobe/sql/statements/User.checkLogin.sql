SELECT
    *
FROM
    users
where
    username = :username
    AND password = :password
LIMIT
    1;