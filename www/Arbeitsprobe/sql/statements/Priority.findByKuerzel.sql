SELECT
    *
FROM 
    kxi_priorities
WHERE kuerzel = :kuerzel
LIMIT 1;