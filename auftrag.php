<?php
session_start();
require_once './repositories/User.repo.php';
require_once './classes/User.class.php';
require_once './repositories/Auftrag.repo.php';
require_once './repositories/Modus.repo.php';
require_once './repositories/Kommentar.repo.php';
if (!(isset($_SESSION['userid']) && isset($_GET['id']))) {
    header("Location: ./");
} else {
    $user = UserRepository::find($_SESSION['userid']);
    if (!$user || !(in_array($user->getUsertype(), User::getSupervisedUsertypes()))) {
        header("Location: ./");
    }
    if (isset($_GET['m']) && in_array($_GET['m'], ModusRepository::asArray("kuerzel"))) {
        AuftragRepository::updateModus($_GET['id'], $_GET['m']);
    }
    if (isset($_GET['v'])) {
        $vMode = $_GET['v'] === "1" ? true : false;
        AuftragRepository::setVisibility($_GET['id'], $vMode);
    }
    if (isset($_POST['comment'])) {
        KommentarRepository::add($_SESSION['userid'], $_GET['id'], $_POST['comment']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KXI-Service</title>
    <?php
include './incs/bootstrap.head.inc.php';
?>
    <link rel="stylesheet" href="./style.css" />
</head>
<body>
    <div class="container">
        <div class="col pt-4 pb-4">
            <div class="row pl-3 pr-3 d-flex">
                <h1>KXI</h1>
                <div class="ml-auto options d-flex pt-3 pb-3">
                    <a href="./dashboard.php" class="fas fa-compass fa-2x align-self-end ml-3 text-decoration-none"></a>
                    <a href="./logout.php" class="fas fa-sign-out-alt fa-2x ml-3 align-self-end text-decoration-none"></a>
                </div>
            </div>
            <div class="row p-3 pt-5">
                <?php
$auftrag = AuftragRepository::find($_GET['id']);

if (!$auftrag) {
    echo "<div class=\"mt-5 col-md-12 p-4 vw-100 border bg-light rounded\" style=\"border-color:#bfc0c0;\">
                        <div class=\"p-2 text-center\" style=\"color:#7f7f7f;\">Dieser Auftrag existiert nicht.</div>
                    </div>";
} else {
    echo $auftrag;
}
?>
            </div>
        </div>
        <div class="modal" id="commentModal" tabindex="-1" role="dialog">
            <form class="modal-dialog modal-dialog-centered" role="document" action="auftrag.php?id=<?=$_GET['id'];?>" METHOD="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Kommentar hinzufügen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Auftragnummer</label>
                            <input type="number" disabled class="form-control text-right" value="<?=$_GET['id'];?>"/>
                        </div>
                        <div class="form-group">
                            <label for="comment">Kommentartext</label>
                            <textarea class="form-control" name="comment" rows="3" id="comment"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Senden</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>