<?php

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
}
