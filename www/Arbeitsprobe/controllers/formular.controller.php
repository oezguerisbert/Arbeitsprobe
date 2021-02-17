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
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $birthdate = $_POST['birthdate'];
        $gender = $_POST['gender'];
        $height = $_POST['height'];
        $serviceid = ServiceRepository::findByKuerzel(strtolower($_GET['service']))->getID();
        $errors = checkInput(
            array(
                "firstname" => $firstname,
                "lastname" => $lastname,
                "birthdate" => $birthdate,
                "gender" => $gender,
                "height" => $height,
                "service" => $service
            )
        );
        if (sizeof($errors) === 0) {
            $cart = CartRepository::findByUser(intval($_SESSION['userid']));
            if(!$cart){
                CartRepository::create(array(":userid"=>intval($_SESSION['userid'])));
                $cart = CartRepository::findByUser(intval($_SESSION['userid']));
            }
            $cart->addItem(
                array(
                    ":serviceid" => $serviceid,
                    ":firstname" => $firstname,
                    ":lastname" => $lastname,
                    ":gender" => $gender,
                    ":height" => $height,
                    ":birthdate" => $birthdate
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
        echo createAlert($db_query_result, "✨ Perfekt!", array("Super, we added the Item into the <a href='./cart.php'>Cart</a>."));
        echo "<a class=\"btn btn-secondary\" href=\"javascript:document.location.href= './';\">zurück</a>";
    } else if (isset($errors) && sizeof($errors) > 0) {
        echo createAlert("warning", "Opps!", $errors);
    } else {
    }
}
