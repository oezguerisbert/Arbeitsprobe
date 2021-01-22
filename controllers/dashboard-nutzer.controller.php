<?php
require_once __DIR__.'/../incs/createInput.func.inc.php';
require_once __DIR__.'/../incs/createSelect.func.inc.php';
require_once __DIR__.'/../incs/createAlert.func.inc.php';
require_once __DIR__.'/../incs/checkInput.func.inc.php';
$page = $_GET['p'] ?? 1;
$limit = 20;
$users = UserRepository::findAll($page);
$next_page = $page + min(count($users)-1,$limit);
$previous_page = max(1,$page - max(count($users)-1,$limit));
$mode = "list";
if(isset($_GET['id']))
{
    $mode =  "edit";
}

if(isset($_GET['add']))
{
    $mode =  "formular";
}


function loadUser(int $id){
    $user = UserRepository::find($id);
    $userdata["username"] = $user->getUsername();
    $userdata["vorname"] = $user->getVorname();
    $userdata["nachname"] = $user->getNachname();
    $userdata["gender"] = $user->getGender();
    $userdata["birthdate"] = $user->getBirthdate();
    $userdata["height"] = $user->getHeight();
    $userdata["email"] = $user->getEmail();
    $userdata["phone"] = $user->getPhone();
    return $userdata;
}
if($mode === "formular"){
    /**
     * Erstellt die Alerts für den Register-Request
     */
    function printResult()
    {

        $data = array();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $data["username"] = htmlspecialchars($_POST['username']);
            $data["vorname"] = htmlspecialchars($_POST['vorname']);
            $data["nachname"] = htmlspecialchars($_POST['nachname']);
            $data["gender"] = htmlspecialchars($_POST['gender']);
            $data["birthdate"] = date('Y-m-d',strtotime($_POST['birthdate']));
            $data["height"] = intval(htmlspecialchars($_POST['height']));
            $data["email"] = htmlspecialchars($_POST['email']);
            $data["phone"] = htmlspecialchars($_POST['phone']);
            $data["password"] = hash("sha256", $_POST['password']);
            $data_errors = checkInput($data);
            $data_ok = sizeof($data_errors) == 0;

            $db_query_result = UserRepository::create($data);
            if ($db_query_result) {
                echo createAlert("success", "Created!", $data_errors);
            } else if (isset($data_errors) && sizeof($data_errors) > 0) {
                echo createAlert("warning", "Opps!", $data_errors);
            }
        }
    }
}
if($mode === "edit"){
    /**
     * Erstellt die Alerts für den Register-Request
     */
    function printResult()
    {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $data["username"] = htmlspecialchars($_POST['username']);
            $data["vorname"] = htmlspecialchars($_POST['vorname']);
            $data["nachname"] = htmlspecialchars($_POST['nachname']);
            $data["gender"] = htmlspecialchars($_POST['gender']);
            $data["birthdate"] = date('Y-m-d',strtotime($_POST['birthdate']));
            $data["height"] = intval(htmlspecialchars($_POST['height']));
            $data["email"] = htmlspecialchars($_POST['email']);
            $data["phone"] = htmlspecialchars($_POST['phone']);
            $data_errors = checkInput($data);
            $data_ok = sizeof($data_errors) == 0;

            $db_query_result = UserRepository::update(intval($_GET['id']), $data);
            if ($db_query_result) {
                echo createAlert("success", "Updated!", $data_errors);
            } else if (isset($data_errors) && sizeof($data_errors) > 0) {
                echo createAlert("warning", "Opps!", $data_errors);
            }
        }
    }
    
}