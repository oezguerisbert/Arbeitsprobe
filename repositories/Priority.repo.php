<?php
require_once "./repositories/Base.repo.php";
require_once "./classes/Priority.class.php";

class PriorityRepository extends BaseRepository
{
    private static $fetch_class = 'Priority';
    public static function findAll()
    {
        $stmt = PriorityRepository::stmt("SELECT * FROM kxi_priorities;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, PriorityRepository::$fetch_class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public static function findByKuerzel(string $kuerzel)
    {
        $stmt = PriorityRepository::stmt("SELECT * FROM kxi_priorities WHERE kuerzel = :kuerzel LIMIT 1;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, PriorityRepository::$fetch_class);
        $stmt->execute(array("kuerzel" => $kuerzel));
        return $stmt->fetch();
    }
    public static function find(int $id)
    {
        $stmt = PriorityRepository::stmt("SELECT * FROM kxi_priorities WHERE id = :id;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, PriorityRepository::$fetch_class);
        $stmt->execute(array("id" => $id));
        return $stmt->fetch();
    }
}
