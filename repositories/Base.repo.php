<?php
require_once "./classes/DB.class.php";


/**
 * Base Repsitory
 */
class BaseRepository extends DB
{
    /**
     * Findet alle Entities aus der Datenbank
     * @return mixed[] Entities
     */
    public static function findAll()
    {
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";
        $stmt = BaseRepository::stmt(file_get_contents("./sql/statements/$filename"));
        $stmt->setFetchMode(PDO::FETCH_CLASS, str_replace("Repository", "", get_called_class()));
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Findet ein Entity aus der Datenbank
     * @param int $id id des Entity
     * @return mixed Entity
     */
    public static function find(int $id)
    {
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";
        $stmt = BaseRepository::stmt(file_get_contents("./sql/statements/$filename"));
        $stmt->setFetchMode(PDO::FETCH_CLASS, str_replace("Repository", "", get_called_class()));
        $stmt->execute(array("id" => $id));
        return $stmt->fetch();
    }

    /**
     * Findet ein Entity aus der Datenbank mit dem Kürzel
     * @param string $kuerzel Kürzel des Entity
     * @return mixed Entity
     */
    public static function findByKuerzel(string $kuerzel)
    {
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";
        $stmt = BaseRepository::stmt(file_get_contents("./sql/statements/$filename"));
        $stmt->setFetchMode(PDO::FETCH_CLASS, str_replace("Repository", "", get_called_class()));
        $stmt->execute(array("kuerzel" => $kuerzel));
        return $stmt->fetch();
    }

    /**
     * Findet erstellt ein Entity in der Datenbank
     * @return array $options Optionen
     */
    public static function create(array $options)
    {
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";
        return BaseRepository::insert(
            file_get_contents("./sql/statements/$filename"),
            $options
        );
    }
}
