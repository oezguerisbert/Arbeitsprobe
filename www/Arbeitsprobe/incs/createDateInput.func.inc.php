<?php
/**
 * Erstellt die Date-Inputs auf Bootstrap-Basis
 *
 * @param string $name name
 * @param string $value wert
 * @param string $type type
 * @param string $hint [optional] hint
 * @param bool $isRequired pflichtfeld
 */
function createDateInput(string $name, string $value, array $min_max = array("min" => null, "max" => null), $hint = "", bool $isRequired = false, string $size = "")
{
    return "<div class=\"form-group $size\">
    <label for=\"$name\">" . ucfirst($name) . "</label>
    <input type=\"date\" class=\"form-control\" id=\"$name\" name=\"$name\" value=\"$value\" ".($min_max['min'] !== null ? "min=\"".date("Y-m-d", $min_max['min'])."\"":"")." ".($min_max['max'] !== null ? "max=\"".date("Y-m-d",$min_max['max'])."\"":"")." placeholder=\"" . ucfirst($name) . "\" " . ($isRequired ? "required" : "") . ">
    " . (empty($hint) ? "" : "<small id=\"" . $name . "Help\" class=\"form-text text-muted\">$hint</small>") . "
</div>";
}
