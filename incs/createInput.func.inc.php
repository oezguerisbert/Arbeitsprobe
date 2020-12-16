<?php
    function createInput(string $name, string $value, string $type, $hint = "", bool $isRequired){

        return "<div class=\"form-group\">
        <label for=\"$name\">".ucfirst($name)."</label>
        <input type=\"$type\" class=\"form-control\" id=\"$name\" name=\"$name\" value=\"$value\" placeholder=\"".ucfirst($name)."\" ".($isRequired ? "required" : "").">
        ".(empty($hint) ? "" : "<small id=\"".$name."Help\" class=\"form-text text-muted\">$hint</small>")."
    </div>";
    }
?>