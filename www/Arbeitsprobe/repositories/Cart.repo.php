<?php

/**
 * Warenkorb Repository
 */
class CartRepository extends BaseRepository
{

    /**
     * Findet den Warenkorb via User-ID
     *
     * @param int $id id des Users
     */
    public static function findByUser(int $id)
    {
        $className = str_replace("Repository", "", get_called_class());
        $result = BaseRepository::run(
            file_get_contents(BaseRepository::findSQLFile($className . "." . __FUNCTION__ . ".sql")),
            array(":userid" => $id),
            $className,
            "fetch"
        );
        return $result;
    }
    /**
     * Findet einen Warenkorb via Cart-ID
     *
     * @param int $id id des Users
     */
    public static function findAny(int $id)
    {
        $className = str_replace("Repository", "", get_called_class());
        $result = BaseRepository::run(
            file_get_contents(BaseRepository::findSQLFile($className . "." . __FUNCTION__ . ".sql")),
            array(":id" => $id),
            $className,
            "fetch"
        );
        return $result;
    }

    
    /**
     * Deactiviert den Warenkorb
     *
     * @param int $id id des Warenkorbs
     */
    public static function deactivate(int $id)
    {
        $className = str_replace("Repository", "", get_called_class());
        $result = BaseRepository::run(
            file_get_contents(BaseRepository::findSQLFile($className . "." . __FUNCTION__ . ".sql")),
            array(":id" => $id)
        );
        return $result;
    }

    

}
