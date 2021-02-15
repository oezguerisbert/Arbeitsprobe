<?php

/*
In diesem Controller wird die Logik für das Dashboard übernommen.

 - LoginCheck
 - initialisierung der `$auftraege`-Variablen

*/
if (isset($_SESSION['userid'])) {
    $user = UserRepository::find($_SESSION['userid']);
    
    if (!$user) {
        header("Location: ../login.php");
    }

    if (!($user->isAdmin() || $user->isModerator())) {
        header("Location: ./");
    }

    $tasks = AuftragRepository::findAll();
    if(!$tasks) $tasks = array();
} else {
    header("Location: ./");
}
