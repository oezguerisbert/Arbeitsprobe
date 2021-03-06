<?php

/**
 * Warenkorb Repository
 */
class CartItemRepository extends BaseRepository
{
    /**
     * Update Statement
     *
     * @param int $id id vom Auftrag
     * @param string $col Spalte
     * @param mixed $value Wert
     */
    public static function updateColumn(int $id, string $col, $value)
    {
        $result = BaseRepository::run(
            "UPDATE kxi_cart SET $col = :value WHERE id = :id;",
            array(":id" => $id, ":value" => $value),
            str_replace("Repository", "", get_called_class()),
            "fetch"
        );
        return $result;
    }

    /**
     * Findet Aufträge via User-ID
     *
     * @param int $id id des Users
     */
    public static function findByCart(int $id)
    {
        $className = str_replace("Repository", "", get_called_class());
        $result = BaseRepository::run(
            file_get_contents(BaseRepository::findSQLFile($className . "." . __FUNCTION__ . ".sql")),
            array(":cartid" => $id),
            $className,
            "fetchAll"
        );
        return $result;
    }

    /**
     * Findet Warenkorb einträge via User-ID
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
            "fetchAll"
        );
        return $result;
    }
}
