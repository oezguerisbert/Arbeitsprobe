<?php
require_once './repositories/Priority.repo.php';
require_once "./classes/Service.class.php";
require_once "./repositories/Base.repo.php";

/**
 * Service Repository
 */
class ServiceRepository extends BaseRepository
{
    /**
     * Fügt einen neuen Service hinzu
     * 
     * @param array $information informationen
     * @return boolean ergebnis
     */
    public static function add(array $information)
    {
        return ServiceRepository::insert(
            "INSERT INTO kxi_auftraege(prioid, serviceid, userid)
            VALUE(:prioid, :serviceid, :uid)",
            array(
                "serviceid" => ServiceRepository::findByKuerzel($information['service'])->getID(),
                "prioid" => PriorityRepository::findByKuerzel($information['priority'])->getID(),
                "uid" => $information['userid'],
            )
        );
    }
}
