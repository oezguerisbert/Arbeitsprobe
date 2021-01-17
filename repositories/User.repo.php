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
        $result = BaseRepository::run(
            file_get_contents("./sql/statements/$filename"), 
            $userdata,
            str_replace("Repository", "", get_called_class()),
            "fetch"
        );
        return $result;
    }
}
