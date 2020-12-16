<?php
include_once './incs/createAlert.func.inc.php';
include_once './incs/createInput.func.inc.php';
$login_blocked = false;

function printResult()
{

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $data = array(
            "username" => $_POST['username'],
            "password" => hash("sha256", $_POST['password']),
        );
        $data_errors = checkInput($data);
        if (sizeof($data_errors) == 0) {
            $user = UserRepository::checkLogin($data);
            if ($user) {
                $_SESSION['userid'] = $user->getID();
                header("Location: ./" . ($_GET['redirect'] ?? ""));
            } else {
                $data_errors = array("password" => "Please retry, user/password wrong.");
                $_SESSION['loginattempts'] = isset($_SESSION['loginattempts']) ? $_SESSION['loginattempts'] + 1 : 1;
                if (!isset($_SESSION['lastloginattempt'])) {
                    $data_errors = array("blockout" => "You tried to login too many times. Take a break!");
                } else {
                    if ($_SESSION['loginattempts'] >= 3 && strtotime("now") - $_SESSION['lastloginattempt'] <= 50) {
                        $data_errors = array("blockout" => "You are blocked from logging in!");
                        $login_blocked = true;
                    } else {

                        $_SESSION['loginattempts'] = 0;
                    }
                }
                $_SESSION['lastloginattempt'] = strtotime("now");

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
