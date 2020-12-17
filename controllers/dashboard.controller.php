<?php
require_once './repositories/User.repo.php';
require_once './repositories/Auftrag.repo.php';

/*
In diesem Controller wird die Logik für das Dashboard übernommen.

 - LoginCheck
 - initialisierung der `$auftraege`-Variablen

*/
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


/**
 * Erstellt alle Aufträge für die Auflistung
 */
function printAuftraege()
{
    global $auftraege;
    foreach ($auftraege as $key => $auftrag) {

        echo $auftrag->toRow();
    }

}
