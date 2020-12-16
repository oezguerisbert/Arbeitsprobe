SELECT
    *
FROM
    kxi_auftrag_kommentare
where
    auftragid = :auftragid
ORDER BY
    addedAt DESC;