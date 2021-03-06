<?php

/**
 * Überprüft ob die Inputs leer sind.
 *
 * Das Array muss wie folgt aufgebaut sein:
 *
 * `KEY:string => VALUE:mixed`
 *
 *
 * @param array input-array
 * @return array Fehler Meldungen
 */
function checkInput(array $array)
{
    $errors = array();
    foreach ($array as $key => $value) {
        if (empty(trim($value . ""))) {
            $errors[] = "You have to fill '" . ucfirst($key) . "' correct.";
        }

    }
    return $errors;
}
