<?php
/**
 * Erstellt die Inputs auf Bootstrap-Basis
 * 
 * @param string $name name
 * @param string $value wert
 * @param array $values type
 * @param string $hint [optional] hint
 * @param bool $isRequired pflichtfeld
 */
function createSelect(string $name, string $value, array $values, $hint = "", bool $isRequired){

    return "<div class=\"form-group\">
    <label for=\"$name\">".ucfirst($name)."</label>
    <select class=\"form-control\" id=\"$name\" name=\"$name\" value=\"$value\" placeholder=\"".ucfirst($name)."\" ".($isRequired ? "required" : "").">
    ".createOptions($values, $value)."
    </select>
    ".(empty($hint) ? "" : "<small id=\"".$name."Help\" class=\"form-text text-muted\">$hint</small>")."
</div>";
}

/**
 * Erstellt die Optionen für ein Select
 * 
 * @param array
 */
function createOptions(array $values, $selection){
    $result = "";
    foreach($values as $key => $value) {
        $result .= "<option value=\"$value\" ".($value === $selection ? "selected" : "").">$value</option>";
    }
    return $result;
}
?>