<?php
function __autoload($classname){
    $checks = array("classes" => "class", "repositories" => "repo");
    $r = "";
    foreach($checks as $key => $check){
        if($key === "repositories"){
            $classname = str_replace("Repository", "", $classname);
        }
        
        // var_dump(array($key, $check, $classname));
        if(file_exists(__DIR__."/../$key/".$classname.".$check.php")){
            $r = $key;
            break;
        }
    }
    if($r !== ""){
        require_once __DIR__."/../$r/".$classname.".".$checks[$r].".php";
    }else {
        throw new Error("Class '$classname' not found!");
    }
}