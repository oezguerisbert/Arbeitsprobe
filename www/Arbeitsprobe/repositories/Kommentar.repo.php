<?php
/**
 * Kommentar Repository
 */
class KommentarRepository extends BaseRepository
{
    /**
     * Findet alle Kommentare nach der AuftragsID
     * 
     * @param int $auftragid
     * @return Kommentar[] Kommentare-Array
     */
    public static function findAllByID(int $auftragid)
    {
        $className = str_replace("Repository", "", get_called_class());

        $result = BaseRepository::run(
            file_get_contents(BaseRepository::findSQLFile($className . "." . __FUNCTION__ . ".sql")), 
            array(":auftragid" => $auftragid),
            $className,
            "fetchAll"
        );
        return $result;
    }
    /**
     * Fügt einen neuen Kommentar hinzu
     * 
     * @param int $userid
     * @param int $auftragid
     * @param string $content
     * @return boolean ergebnis
     */
    public static function add(int $userid, int $auftragid, string $content)
    {
        $className = str_replace("Repository", "", get_called_class());
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";

        $result = BaseRepository::run(
            file_get_contents(BaseRepository::findSQLFile($className . "." . __FUNCTION__ . ".sql")), 
            array(":userid" => $userid, ":auftragid" => $auftragid, ":content" => htmlspecialchars($content)),
            str_replace("Repository", "", get_called_class()),
            ""
        );
        return $result;
    }
}
