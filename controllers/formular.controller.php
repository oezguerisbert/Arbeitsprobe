<?php

$service = $_GET['service'];
require_once './incs/checkInput.func.inc.php';
require_once './incs/getPrioDays.func.inc.php';
require_once './repositories/Service.repo.php';
require_once './repositories/Priority.repo.php';
require_once './classes/DB.class.php';

if (isset($_SESSION['userid'])) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $prio = $_POST['prio'];
        $errors = checkInput(array("priority" => $prio));
        if (sizeof($errors) === 0) {
            $db_result = ServiceRepository::add(array("userid" => $_SESSION['userid'], "service" => strtolower($service), "priority" => $prio));
            $db_query_result = $db_result ? "success" : "warning";
        }
    }
} else {
    header("Location: ./login.php?redirect=" . "formular.php?service=$service");
}

function printResult()
{
    global $db_query_result;
    global $errors;
    global $prio;
    if (isset($db_query_result) && sizeof($errors) === 0) {
        echo createAlert($db_query_result, "✨ Perfekt!", array("Wir werden Sie am " . (date("d.m.Y", strtotime("+" . getPrioDays($prio) . " days"))) . " (in " . getPrioDays($prio) . " Tagen) kontaktieren."));
        echo "<a class=\"btn btn-secondary\" href=\"javascript:document.location.href= './';\">zurück</a>";
    } else if (isset($errors) && sizeof($errors) > 0) {
        echo createAlert("warning", "Opps!", $errors);
    } else {
    }
}
