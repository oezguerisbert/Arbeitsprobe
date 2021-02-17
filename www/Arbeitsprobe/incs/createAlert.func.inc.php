<?php
/**
 * Erstellt die Boots-Alerts
 *
 *
 * @param string type
 * @param string titel
 * @param array alerts-array
 * @return string HTML-Bootstrap-Alert
 */
function createAlert(string $type, string $title, array $alerts, bool $li = true)
{
    $d = "<div class=\"alert alert-$type\" role=\"alert\">";
    $d .= "<h5>$title</h5>";
    $style = $li ? "" : "style='list-style-type: none;'";
    foreach ($alerts as $key => $value) {
        $d .= "<li class=\"\" $style>$value</li>";
    }
    ;
    $d .= "</div>";
    return $d;
}
