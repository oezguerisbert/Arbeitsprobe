<?php
include_once './incs/createAlert.func.inc.php';
include_once './incs/createInput.func.inc.php';
$login_blocked = false;

/**
 * Erstellt die Alerts für den Login-Request
 */
function printResult()
{

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $data = array(
            ":username" => $_POST['username'],
            ":password" => hash("sha256", $_POST['password']),
        );
        $data_errors = checkInput($data);
        if (sizeof($data_errors) == 0) {
            $user = UserRepository::checkLogin($data);
            if ($user) {
                $_SESSION['userid'] = $user->getID();
                print "<script>document.location.href = './';</script>";
            } else {
                $data_errors = array("password" => "Please retry, user/password wrong.");
            }
        }

    }
    if (isset($data_errors) && sizeof($data_errors) > 0) {
        if ($_SESSION['loginattempts'] < 3 && !$login_blocked) {
            echo createAlert("warning", "😱 Something went wrong!", $data_errors);
        } else {
            echo createAlert("danger", "😠", $data_errors);

        }
    }
}
