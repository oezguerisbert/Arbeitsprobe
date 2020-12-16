<?php
    function checkInput(array $array){
        $errors = array();
        foreach ($array as $key => $value) {
            if(empty(trim($value))){
                $errors[] = "Sie müssen '".ucfirst($key)."' richtig ausfüllen";
            }
            
        }
        return $errors;
    }
?>