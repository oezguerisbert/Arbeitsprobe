<?php
require_once "./repositories/Base.repo.php";
require_once "./classes/Priority.class.php";

/**
 * Priority Repository
 */
class PriorityRepository extends BaseRepository
{
    private static $fetch_class = 'Priority';

    /**
     * Findet alle Prioritäten aus der Datenbank
     * 
     * @return Priority[] prioritäten
     */
    public static function findAll()
    {
        $stmt = PriorityRepository::stmt("SELECT * FROM kxi_priorities;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, PriorityRepository::$fetch_class);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Findet eine Priorität aus der Datenbank via Kürzel
     * 
     * @param int $kuerzel Kürzel der Priorität
     * @return Priority priorität
     */
    public static function findByKuerzel(string $kuerzel)
    {
        $stmt = PriorityRepository::stmt("SELECT * FROM kxi_priorities WHERE kuerzel = :kuerzel LIMIT 1;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, PriorityRepository::$fetch_class);
        $stmt->execute(array("kuerzel" => $kuerzel));
        return $stmt->fetch();
    }

    /**
     * Findet eine Priorität aus der Datenbank via ID
     * 
     * @param int $id id von der Priorität
     * @return Priority priorität
     */
    public static function find(int $id)
    {
        $stmt = PriorityRepository::stmt("SELECT * FROM kxi_priorities WHERE id = :id;");
        $stmt->setFetchMode(PDO::FETCH_CLASS, PriorityRepository::$fetch_class);
        $stmt->execute(array("id" => $id));
        return $stmt->fetch();
    }
}
