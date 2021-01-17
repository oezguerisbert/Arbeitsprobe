INSERT INTO
    users(
        username,
        vorname,
        nachname,
        gender,
        phone,
        email,
        password
    ) VALUE(
        :username,
        :vorname,
        :nachname,
        :gender,
        :phone,
        :email,
        :password
    )