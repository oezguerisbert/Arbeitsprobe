<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KXI-Service</title>
    <?php
include '../incs/bootstrap.head.inc.php';
?>
</head>
<body>
    <div class="container">
        <div class="col pt-4 pb-4" >
            <div class="row pl-3 pr-3 d-flex">
                <h1>KXI</h1>
                <div class="ml-auto options d-flex pt-3 pb-3">
                    <a href="javascript:document.location.reload();" class="fas fa-sync-alt fa-2x align-self-end text-decoration-none"></a>
                    <a href="./" class="fas fa-compass fa-2x align-self-end ml-3 text-decoration-none"></a>
                    <a href="../logout.php" class="fas fa-sign-out-alt fa-2x ml-3 align-self-end text-decoration-none"></a>
                </div>
            </div>
            <h2>Dashboard</h2>
            <h3>Nutzer</h3>
            <?php
if ($mode === "list") {
    ?>
                    <div class="row row-cols-4 pl-3 pr-3 justify-content-start" >
                        <?php
foreach ($users as $k => $user) {
        print "<a href='./nutzer.php?id={$user->getID()}' class='card p-2 mr-2'><span>{$user->getUsername()}</span></a>";
    }

    ?>

                    </div>
                    <div class="col p-0 mt-5">
                        <a href='./nutzer.php?add' class='btn btn-primary fa fa-plus' style='height:40px;width:45px !important; font-size:1.2rem;padding-top:9px;'></a>
                        <div class="row pl-3 pr-3 mt-2 ">
                            <a class="btn btn-secondary col-1 mr-2 <?php echo $page == 1 ? "disabled" : ""; ?>" style="float:left;" href="./nutzer.php?p=<? print $previous_page ?>">Previous</a>
                            <a class="btn btn-secondary col-1" style="float:left;" href="./nutzer.php?p=<? print $next_page ?>">Next</a>
                        </div>
                    </div>
                    <?php
}
if ($mode === "edit") {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        printResult();
    }
    ?>
                    <?php $data = loadUser(intval($_GET['id']));?>
                    <form class="col p-3 pt-4 m-auto" action="<?=$_SERVER['PHP_SELF'];?>?id=<?php echo $_GET['id']; ?>" method="POST" <?php echo $mode === "formular" ? "style='width:40vw; min-width:400px;'" : ""; ?>>
                        <?=createInput("username", $data["username"], "text", null, true);?>
                        <?=createInput("vorname", $data["vorname"], "text", null, true);?>
                        <?=createInput("nachname", $data["nachname"], "text", null, true);?>
                        <?=createInput("phone", $data["phone"], "phone", "Ihre Telefonnummer wird nicht weitergegeben.", true);?>
                        <?=createInput("email", $data["email"], "email", "Ihre E-Mail wird nicht weitergegeben.", true);?>
                        <?
                        if(isset($data["usertype"]) && $data["usertype"] !== "admin"){
                            echo createSelect("usertype", isset($data["usertype"]) ? $data["usertype"] : "", array("admin", "moderator", "user"), "Das sind die Nutzerrechte.", true);
                        }
                        ?>
                        <div class="col d-flex p-0 mt-3">
                            <a href="./nutzer.php" class="btn btn-danger">Abbrechen</a>
                            <button type="submit" class="btn btn-primary ml-auto align-self-end">Speichern</button>
                        </div>
                    </form>
                    <?php
}
if ($mode === "formular") {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        echo "<div class='col-7 m-auto'>";
        printResult();
        echo "</div>";
    }
    ?>
                    <form class="col p-3 pt-4 m-auto" action="<?=$_SERVER['PHP_SELF'];?>?add" method="POST" <?php echo $mode === "formular" ? "style='width:40vw; min-width:400px;'" : ""; ?>>
                        <?=createInput("username", (isset($data_ok) && !$data_ok) ? $data["username"] : "", "text", null, true);?>
                        <?=createInput("vorname", (isset($data_ok) && !$data_ok) ? $data["vorname"] : "", "text", null, true);?>
                        <?=createInput("nachname", (isset($data_ok) && !$data_ok) ? $data["nachname"] : "", "text", null, true);?>
                        <?=createInput("phone", (isset($data_ok) && !$data_ok) ? $data["phone"] : "", "phone", "Ihre Telefonnummer wird nicht weitergegeben.", true);?>
                        <?
                        if(isset($data["usertype"]) && $data["usertype"] !== "admin"){
                            echo createSelect("usertype", (isset($data_ok) && !$data_ok) ? $data["usertype"] : "", array("admin", "moderator", "user"), "Das sind die Nutzerrechte.", true);
                        }
                        ?>
                        <?=createInput("email", (isset($data_ok) && !$data_ok) ? $data["email"] : "", "email", "Ihre E-Mail wird nicht weitergegeben.", true);?>
                        <?=createInput("password", (isset($data_ok) && !$data_ok) ? $data["password"] : "", "password", null, true);?>
                        <div class="col d-flex p-0 mt-3">
                            <a href="./nutzer.php" class="btn btn-danger">Abbrechen</a>
                            <button type="submit" class="btn btn-primary ml-auto align-self-end">Register</button>
                        </div>
                    </form>
                    <?php
}
?>
        </div>
    </div>
</body>
</html>