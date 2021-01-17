INSERT INTO
    users(
        username,
        vorname,
        nachname,
        gender,
        height,
        birthdate,
        phone,
        email,
        password
    ) VALUE(
        :username,
        :vorname,
        :nachname,
        :gender,
        :height,
        :birthdate,
        :phone,
        :email,
        :password
    )