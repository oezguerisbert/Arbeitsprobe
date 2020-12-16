<?php
include_once './incs/checkInput.func.inc.php';
include_once './repositories/User.repo.php';

function printResult()
{

    $data = array(
        "username" => null,
        "vorname" => null,
        "nachname" => null,
        "email" => null,
        "password" => null,
    );

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $data["username"] = htmlspecialchars($_POST['username']);
        $data["vorname"] = htmlspecialchars($_POST['vorname']);
        $data["nachname"] = htmlspecialchars($_POST['nachname']);
        $data["email"] = htmlspecialchars($_POST['email']);
        $data["phone"] = htmlspecialchars($_POST['phone']);
        $data["password"] = hash("sha256", $_POST['password']);
        $data_errors = checkInput($data);
        $data_ok = sizeof($data_errors) == 0;

        $db_query_result = UserRepository::create($data);
        if ($db_query_result) {
            $_SESSION['userid'] = UserRepository::checkLogin(array("username" => htmlspecialchars($data['username']), "password" => $data['password']))->getID();
            echo "<script>document.location.href = '" . (isset($_GET['redirect']) ? $_GET['redirect'] : "./index.php") . "';</script>";
        } else if (isset($data_errors) && sizeof($data_errors) > 0) {
            echo createAlert("warning", "Opps!", $data_errors);
        }
    }
}
