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
        
        $result = BaseRepository::run(
            "SELECT * FROM kxi_priorities;", 
            null,
            str_replace("Repository", "", get_called_class()),
            "fetchAll"
        );
        return $result;
    }

    /**
     * Findet eine Priorität aus der Datenbank via Kürzel
     * 
     * @param int $kuerzel Kürzel der Priorität
     * @return Priority priorität
     */
    public static function findByKuerzel(string $kuerzel)
    {
        $result = BaseRepository::run(
            "SELECT * FROM kxi_priorities WHERE kuerzel = :kuerzel LIMIT 1;", 
            array("kuerzel" => $kuerzel),
            str_replace("Repository", "", get_called_class()),
            "fetch"
        );
        return $result;
    }

    /**
     * Findet eine Priorität aus der Datenbank via ID
     * 
     * @param int $id id von der Priorität
     * @return Priority priorität
     */
    public static function find(int $id)
    {
        $result = BaseRepository::run(
            "SELECT * FROM kxi_priorities WHERE id = :id;", 
            array("id" => $id),
            str_replace("Repository", "", get_called_class()),
            "fetch"
        );
        return $result;
    }
}
