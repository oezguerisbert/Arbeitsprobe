UPDATE
    users
SET
    username = :username,
    vorname = :vorname,
    nachname = :nachname,
    birthdate = :birthdate,
    gender = :gender,
    height = :height,
    phone = :phone,
    email = :email

WHERE id = :id;