UPDATE
    users
SET
    username = :username,
    vorname = :vorname,
    nachname = :nachname,
    usertype = :usertype,
    phone = :phone,
    email = :email
WHERE
    id = :id;