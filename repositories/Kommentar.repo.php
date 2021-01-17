<?php
require_once "./classes/Kommentar.class.php";
require_once "./repositories/Base.repo.php";

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
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";

        $result = BaseRepository::run(
            file_get_contents("./sql/statements/$filename"), 
            array("auftragid" => $auftragid),
            str_replace("Repository", "", get_called_class()),
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
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";

        $result = BaseRepository::run(
            file_get_contents("./sql/statements/$filename"), 
            array("userid" => $userid, "auftragid" => $auftragid, "content" => htmlspecialchars($content)),
            str_replace("Repository", "", get_called_class()),
            ""
        );
        return $result;
    }
}
