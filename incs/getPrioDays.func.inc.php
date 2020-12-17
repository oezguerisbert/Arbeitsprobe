<?php
/**
 * Übergibt die Tage Prioritäten zurück
 * 
 * @return int prio-tage
 */
function getPrioDays($prio){
    $days = array("tief" => 12, "express" => 5, "standart" => 7);
    return $days[strtolower($prio)];
}
?>