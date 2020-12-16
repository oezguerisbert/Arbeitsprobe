<?php
require_once "./classes/DB.class.php";

class BaseRepository extends DB
{
    public static function findAll()
    {
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";
        $stmt = BaseRepository::stmt(file_get_contents("./sql/statements/$filename"));
        $stmt->setFetchMode(PDO::FETCH_CLASS, str_replace("Repository", "", get_called_class()));
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public static function find(int $id)
    {
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";
        $stmt = BaseRepository::stmt(file_get_contents("./sql/statements/$filename"));
        $stmt->setFetchMode(PDO::FETCH_CLASS, str_replace("Repository", "", get_called_class()));
        $stmt->execute(array("id" => $id));
        return $stmt->fetch();
    }
    public static function findByKuerzel(string $kuerzel)
    {
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";
        $stmt = BaseRepository::stmt(file_get_contents("./sql/statements/$filename"));
        $stmt->setFetchMode(PDO::FETCH_CLASS, str_replace("Repository", "", get_called_class()));
        $stmt->execute(array("kuerzel" => $kuerzel));
        return $stmt->fetch();
    }
    public static function create(array $options)
    {
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";
        return BaseRepository::insert(
            file_get_contents("./sql/statements/$filename"),
            $options
        );
    }
}
