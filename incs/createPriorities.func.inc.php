<?php
function createPriorities(array $priorities, string $selected = "")
{
    $d = "";
    foreach ($priorities as $key => $priority) {
        $name = "prio" . ($priority->getID());
        $kuerzel = $priority->getKuerzel();
        $d .= "<div class=\"custom-control custom-radio\">
            <input type=\"radio\" id=\"$name\" name=\"prio\" value=\"" . $kuerzel . "\" class=\"custom-control-input\" required " . (strtolower($kuerzel) === strtolower($selected) ? "checked" : "") . ">
            <label class=\"custom-control-label\" for=\"$name\">" . $priority->getTitle() . "</label>
        </div>";
    }
    return $d;
}
