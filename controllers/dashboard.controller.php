<?php
require_once './repositories/User.repo.php';
require_once './repositories/Auftrag.repo.php';
// require_once './classes/User.class.php';
if (isset($_SESSION['userid'])) {
    $user = UserRepository::find($_SESSION['userid']);
    if (!$user) {
        header("Location: ./login.php");
    }
    $usertype = $user->getUsertype();
    if (!in_array($usertype, User::getSupervisedUsertypes())) {
        header("Location: ./");
    }
    $auftraege = AuftragRepository::findAll();

} else {
    header("Location: ./");
}
function printAuftraege()
{
    global $auftraege;
    foreach ($auftraege as $key => $auftrag) {

        echo $auftrag->toRow();
    }

}
