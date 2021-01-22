<?php


/**
 * Base Repsitory
 */
class BaseRepository extends DB
{

    protected static function findSQLFile($filename){
        $path = $_SERVER['DOCUMENT_ROOT']."/Arbeitsprobe/sql/statements/$filename";
        if(file_exists($path)){
            return $path;
        }else {
            throw new Error("File '$filename' does not exist!");
        }
    }

    /**
     * Findet alle Entities aus der Datenbank
     * @return mixed[] Entities
     */
    public static function findAll(int $page = 1)
    {
        $className = str_replace("Repository", "", get_called_class());
        $result = BaseRepository::run(
            file_get_contents(BaseRepository::findSQLFile($className. "." . __FUNCTION__ . ".sql")), 
            array(":limit" => "20", ":page" => $page),
            $className,
            "fetchAll"
        );
        return $result;
    }

    /**
     * Findet ein Entity aus der Datenbank
     * @param int $id id des Entity
     * @return mixed Entity
     */
    public static function find(int $id)
    {
        $className = str_replace("Repository", "", get_called_class());
        
        $result = BaseRepository::run(
            file_get_contents(BaseRepository::findSQLFile($className. "." . __FUNCTION__ . ".sql")), 
            array(":id" => $id),
            $className,
            "fetch"
        );
        return $result;
    }

    /**
     * Findet ein Entity aus der Datenbank mit dem Kürzel
     * @param string $kuerzel Kürzel des Entity
     * @return mixed Entity
     */
    public static function findByKuerzel(string $kuerzel)
    {
        $className = str_replace("Repository", "", get_called_class());

        $result = BaseRepository::run(
            file_get_contents(BaseRepository::findSQLFile($className. "." . __FUNCTION__ . ".sql")), 
            array(":kuerzel" => $kuerzel),
            $className,
            "fetch"
        );
        return $result;
    }

    /**
     * Findet erstellt ein Entity in der Datenbank
     * @return array $options Optionen
     */
    public static function create(array $options)
    {
        $className = str_replace("Repository", "", get_called_class());
        
        $result = BaseRepository::run(
            file_get_contents(BaseRepository::findSQLFile($className. "." . __FUNCTION__ . ".sql")), 
            $options
        );
        return $result;
    }

    /**
     * Updated ein Entity in der Datenbank
     * @return array $options Optionen
     */
    public static function update(int $id, array $options)
    {
        $className = str_replace("Repository", "", get_called_class());
        
        $result = BaseRepository::run(
            file_get_contents(BaseRepository::findSQLFile($className. "." . __FUNCTION__ . ".sql")), 
            array_merge(array(":id" => $id),$options)
        );
        return $result;
    }
}
