<?php
require_once __DIR__ . '/../incs/createInput.func.inc.php';
require_once __DIR__ . '/../incs/createSelect.func.inc.php';
require_once __DIR__ . '/../incs/createAlert.func.inc.php';
require_once __DIR__ . '/../incs/checkInput.func.inc.php';
$howmanyusers = UserRepository::getAmount();
$page = min($howmanyusers, $_GET['p'] ?? 1);
$limit = 20;
$users = UserRepository::findAll($page);

$next_page = $page + min(count($users) - 1, $limit);
$previous_page = max(1, $page - max(count($users) - 1, $limit));
$mode = "list";
if (isset($_GET['id'])) {
    $mode = "edit";
}

if (isset($_GET['add'])) {
    $mode = "formular";
}

function loadUser(int $id)
{
    $user = UserRepository::find($id);
    $userdata["username"] = $user->getUsername();
    $userdata["vorname"] = $user->getVorname();
    $userdata["nachname"] = $user->getNachname();
    $userdata["email"] = $user->getEmail();
    $userdata["usertype"] = $user->getUsertype();
    $userdata["phone"] = $user->getPhone();
    return $userdata;
}
if ($mode === "formular") {
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
            $data["email"] = htmlspecialchars($_POST['email']);
            $data["phone"] = htmlspecialchars($_POST['phone']);
            $data["password"] = hash("sha256", $_POST['password']);
            $data_errors = checkInput($data);
            $data_ok = sizeof($data_errors) == 0;

            $db_query_result = UserRepository::create($data);
            if (isset($db_query_result['error'])) {
                switch ($db_query_result['error']) {
                    case 'DUPLICATE ENTRY':
                        $data_errors = array(Errors::EMAIL_OR_USER_EXISTS);
                        break;
                    default:
                        $data_errors = array(Errors::unknown($db_query_result['error']));
                        break;
                }
            }
            if ($db_query_result && !isset($db_query_result['error'])) {
                echo createAlert("success", "Created!", array("The User '" . $data["username"] . "' was created successfully!"), false);
            } else if (isset($data_errors) && sizeof($data_errors) > 0) {
                echo createAlert("danger", "Opps!", $data_errors, false);
            }
        }
    }
}
if ($mode === "edit") {
    /**
     * Erstellt die Alerts für den Register-Request
     */
    function printResult()
    {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $data["username"] = htmlspecialchars($_POST['username']);
            $data["vorname"] = htmlspecialchars($_POST['vorname']);
            $data["nachname"] = htmlspecialchars($_POST['nachname']);
            $data["email"] = htmlspecialchars($_POST['email']);
            if (isset($_POST['usertype'])) {
                $data["usertype"] = htmlspecialchars($_POST['usertype']);
            }
            $data["phone"] = htmlspecialchars($_POST['phone']);
            $data_errors = checkInput($data);
            $data_ok = sizeof($data_errors) == 0;
            $data_errors = array();
            $db_query_result2 = false;
            foreach ($data as $dk => $dv) {
                $db_query_result = UserRepository::updateByCollumn(intval($_GET['id']), $dk, $dv);
                if (isset($db_query_result['error'])) {
                    switch ($db_query_result['error']) {
                        case 'DUPLICATE ENTRY':
                            $data_errors[] = Errors::cantUpdate($dk, $dv, "already exists");
                            break;
                        default:
                            $data_errors[] = Errors::unknown($db_query_result['error']);
                            break;
                    }
                } else {
                    $db_query_result2 = $db_query_result2 && $db_query_result;
                }
                if (!$db_query_result2) {
                    break;
                }
            }

            if ($db_query_result && !isset($db_query_result['error'])) {
                echo createAlert("success", "Updated!", array("The User '" . $data["username"] . "' was updated successfully!"), false);
            } else if (isset($data_errors) && sizeof($data_errors) > 0) {
                echo createAlert("danger", "Opps!", $data_errors, false);
            }
        }
    }

}
