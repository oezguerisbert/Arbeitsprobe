<?php

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
        $result = BaseRepository::run(
            "INSERT INTO kxi_auftraege(prioid, serviceid, userid)
            VALUE(:prioid, :serviceid, :uid)", 
            array(
                ":serviceid" => ServiceRepository::findByKuerzel($information['service'])->getID(),
                ":prioid" => PriorityRepository::findByKuerzel($information['priority'])->getID(),
                ":uid" => $information['userid'],
            ),
            null,
            ""
        );
        return $result;
    }
}
