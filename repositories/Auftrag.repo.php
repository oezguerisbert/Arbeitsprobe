<?php

/**
 * Auftrag Repository
 */
class AuftragRepository extends BaseRepository
{
    /**
     * Update Statement
     * 
     * @param int $id id vom Auftrag
     * @param string $col Spalte
     * @param mixed $value Wert
     */
    public static function update(int $id, string $col, $value)
    {
        $result = BaseRepository::run(
            "UPDATE kxi_auftraege SET $col = :value WHERE id = :id;", 
            array(":id" => $id, ":value" => $value),
            str_replace("Repository", "", get_called_class()),
            "fetch"
        );
        return $result;
    }

    /**
     * Setzt die Sichtbarkeit des Auftrags.
     * 
     * @param int $id id vom Auftrag
     * @param boolean $b sichtbarkeit `true` bzw `false`
     */
    public static function setVisibility(int $id, bool $b)
    {
        return AuftragRepository::update($id, "visible", $b ? 1 : 0);
    }

    /**
     * Updated den Modus
     * 
     * @param int $id id des Auftrags
     * @param string $modus modus-name
     */
    public static function updateModus(int $id, string $modus)
    {
        $modus = ModusRepository::findByKuerzel($modus);
        if (!$modus) {
            return false;
        }
        return AuftragRepository::update($id, "modeid", $modus->getID());
    }

    /**
     * Findet Aufträge via User-ID
     * 
     * @param int $id id des Users
     */
    public static function findByUser(int $id)
    {
        $className = str_replace("Repository", "", get_called_class());
        $result = BaseRepository::run(
            file_get_contents(BaseRepository::findSQLFile($className. "." . __FUNCTION__ . ".sql")), 
            array(":userid" => $id),
            $className,
            "fetch"
        );
        return $result;
    }

    /**
     * Findet Aufträge via Moderator(User)-ID
     * 
     * @param int $id id des Users
     */
    public static function findByModerator(int $id)
    {
        $className = str_replace("Repository", "", get_called_class());
        $result = BaseRepository::run(
            file_get_contents(BaseRepository::findSQLFile($className. "." . __FUNCTION__ . ".sql")), 
            array(":moderatorid" => $id),
            $className,
            "fetchAll"
        );
        return $result;
    }


}
