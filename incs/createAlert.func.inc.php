<?php

function createAlert(string $type, string $title, array $alerts) {
    $d = "<div class=\"alert alert-$type\" role=\"alert\">";
    $d .= "<h5>$title</h5>";
    foreach ($alerts as $key => $value) {
        $d .= "<li class=\"\">$value</li>";
    };
    $d .="</div>";
    return $d;
}
?>