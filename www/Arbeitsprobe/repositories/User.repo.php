<?php

/**
 * User Repository
 */
class UserRepository extends BaseRepository
{
    /**
     * Überprüft den Login
     * @return User user
     */
    public static function checkLogin(array $userdata)
    {
        $filename = str_replace("Repository", "", get_called_class()) . "." . __FUNCTION__ . ".sql";
        $result = BaseRepository::run(
            file_get_contents("./sql/statements/$filename"),
            $userdata,
            str_replace("Repository", "", get_called_class()),
            "fetch"
        );
        return $result;
    }

    /**
     * Updated das gesamte Entity in der Datenbank
     * @param int $id id
     * @param array $options Optionen
     * @return mixed result
     */
    public static function updateAll(int $id, array $options)
    {
        $className = str_replace("Repository", "", get_called_class());

        $result = BaseRepository::run(
            file_get_contents(BaseRepository::findSQLFile($className . "." . __FUNCTION__ . ".sql")),
            array_merge(array(":id" => $id), $options)
        );
        return $result;
    }

    /**
     * Updated eine Spalte aus dem Entity in der Datenbank
     * @param int $id id
     * @param array $options Optionen
     * @return mixed result
     */
    public static function updateByCollumn(int $id, string $column, $value)
    {
        $className = str_replace("Repository", "", get_called_class());
        $sql = str_replace("col", $column, file_get_contents(BaseRepository::findSQLFile($className . "." . __FUNCTION__ . ".sql")));
        $result = BaseRepository::run(
            $sql,
            array(":id" => $id, ":val" => $value)
        );
        return $result;
    }
}
