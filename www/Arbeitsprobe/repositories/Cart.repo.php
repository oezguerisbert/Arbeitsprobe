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
        $result = array();
        if (isset($_SESSION['cartid'])) {
            $result = BaseRepository::run(
                file_get_contents(BaseRepository::findSQLFile($className . "." . __FUNCTION__ . ".sql")),
                array(":userid" => $id, ":cartid" => $_SESSION['cartid']),
                $className,
                "fetchAll"
            );
        }
        return $result;
    }

}
