<?php
include_once './incs/createInput.func.inc.php';
if (!file_exists("./config.json")) {
    $conf = array(
        "database" => array(
            "host" => null,
            "port" => 3306,
            "user" => "root",
            "password" => "",
            "dbname" => "modul133",
            "migrate" => true,
        ),
    );
    if ($_SERVER['REQUEST_METHOD'] === "POST") {

        $conf['database']['host'] = $_POST['host'] ?? $conf['database']['host'];
        $conf['database']['port'] = $_POST['port'] ?? $conf['database']['port'];
        $conf['database']['user'] = $_POST['user'] ?? $conf['database']['user'];
        $conf['database']['password'] = $_POST['password'] ?? $conf['database']['password'];

        $configHandle = fopen("./config.json", "w+");
        fwrite($configHandle, json_encode($conf));
        fclose($configHandle);
        sleep(2);
        header("Location: ./");
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
</head>
<body>
    <div class="container col-md-8">
        <div class="col pt-4 pb-4">
            <div class="row pl-3 pr-3 d-flex">
                <h1>KXI - Konfiguration</h1>
            </div>
            <h2>
                Datenbank
            </h2>

            <div class="row row-cols-2 justify-content-around">
                <form method="POST" action="config.php">
                    <?=createInput("host", $_POST['host'] ?? "", "text", "The hostname of the database", false)?>
                    <?=createInput("port", $_POST['port'] ?? "", "number", "The port of the database", false)?>
                    <?=createInput("user", $_POST['user'] ?? "", "text", "The user of the database", false)?>
                    <?=createInput("password", $_POST['password'] ?? "", "password", "The password of the user", false)?>
                    <div class="d-flex">
                        <div class="ml-auto"></div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <div class="row p-5"></div>
        </div>
    </div>
</body>
</html>

    <?php
die();
} else {
    if ($_SERVER['REQUEST_METHOD'] === "GET" && !in_array($_SERVER['REQUEST_URI'], array("/modul-133/Praxisarbeit/", "/modul-133/Praxisarbeit/index.php"))) {
        header("Location: ./");
    }
}
