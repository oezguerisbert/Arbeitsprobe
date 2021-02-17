<?php


class ModusRepository extends BaseRepository
{
    /**
     * Übergibt die Modies als Array
     * @param string $filter [optional] filter nach Namen
     * @return array Modi
     */
    public static function asArray(string $filter = "")
    {
        $result = array();

        $modi = ModusRepository::findAll();
        foreach ($modi as $key => $modus) {
            if (!empty(trim($filter))) {
                $result[] = $modus->toArray()[$filter];
            } else {
                $result[] = $modus->getName();
            }
        }
        return $result;
    }

}
