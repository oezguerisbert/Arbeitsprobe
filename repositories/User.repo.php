<?php
require_once "./classes/User.class.php";
require_once "./repositories/Base.repo.php";

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
        $stmt = DB::stmt(file_get_contents("./sql/statements/$filename"));
        $stmt->setFetchMode(PDO::FETCH_CLASS, str_replace("Repository", "", get_called_class()));
        $stmt->execute($userdata);
        $user = $stmt->fetch();
        return $user;
    }
}
