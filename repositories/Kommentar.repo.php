<?php
require_once "./classes/Kommentar.class.php";
require_once "./repositories/Base.repo.php";

class KommentarRepository extends BaseRepository
{

    public static function findAllByID(int $auftragid)
    {
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";

        $stmt = KommentarRepository::stmt(file_get_contents("./sql/statements/$filename"));
        $stmt->setFetchMode(PDO::FETCH_CLASS, str_replace("Repository", "", get_called_class()));
        $stmt->execute(array("auftragid" => $auftragid));
        $user = $stmt->fetchAll();
        return $user;
    }

    public static function add(int $userid, int $auftragid, string $content)
    {
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";
        return UserRepository::insert(
            file_get_contents("./sql/statements/$filename"),
            array("userid" => $userid, "auftragid" => $auftragid, "content" => htmlspecialchars($content))
        );
    }
}
