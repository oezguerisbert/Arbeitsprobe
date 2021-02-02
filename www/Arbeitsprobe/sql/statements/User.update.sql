UPDATE
    users
SET
    username = :username,
    vorname = :vorname,
    nachname = :nachname,
    phone = :phone,
    email = :email
WHERE
    id = :id;