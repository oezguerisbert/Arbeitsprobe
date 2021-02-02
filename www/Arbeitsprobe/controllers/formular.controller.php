<?php

$service = $_GET['service'];
require_once __DIR__ . '/../incs/checkInput.func.inc.php';
require_once __DIR__ . '/../incs/getPrioDays.func.inc.php';

/*
In diesem Controller wird die Logik für das Ski-Serviceformular übernommen.

- LoginCheck
- Datenbank Resultat nach der Anfrage

 */

if (isset($_SESSION['userid'])) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $prio = $_POST['prio'];
        $amount = intval($_POST['amount']);
        $errors = checkInput(array("priority" => $prio, "amount" => $amount));
        if (sizeof($errors) === 0) {
            $db_result = AuftragRepository::create(
                array(
                    ":userid" => $_SESSION['userid'],
                    ":serviceid" => ServiceRepository::findByKuerzel(strtolower($service))->getID(),
                    ":prioid" => PriorityRepository::findByKuerzel($prio)->getID(),
                    ":amount" => $amount,
                )
            );
            $db_query_result = $db_result ? "success" : "warning";
        }
    }
} else {
    header("Location: ./login.php?redirect=" . "formular.php?service=$service");
}

/**
 * Erstellt die Alerts für das Resultat der Anfrage.
 */
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
