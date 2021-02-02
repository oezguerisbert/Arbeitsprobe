<?php
require_once __DIR__ . '/../incs/createServices.func.inc.php';
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
    <div class="container">
        <div class="col pt-4 pb-4">
            <div class="row pl-3 pr-3 d-flex">
                <h1>KXI</h1>
                <div class="ml-auto options d-flex pt-3 pb-3">
                    <?php printUserOptions();?>
                </div>
            </div>
            <h2>
                Dein Ski-Service in den Alpen 😊⛷
            </h2>
            <br />
            <div class="col p-0 br-2 rounded" style="height:200px;background-image:url('https://bit.ly/3pGh7HS'); background-repeat: no-repeat;background-size:cover;background-position:bottom;"></div>
            <h3 class="pt-4">
                Über uns
            </h3>
            <p class="text-justify">
                Wir sind ein Ski-Unternehmen und bieten verschiedene Projekte an. Wir sind darauf spezialisiert Aufträge hoch professionell auszuführen und bieten die beste Qualität an.
            </p>
            <div class="row row-cols-3 justify-content-around">
                <?=createServices(ServiceRepository::findAll());?>
            </div>
            <div class="row p-5"></div>
        </div>
        <?php include __DIR__ . '/../incs/footer.inc.php';?>
    </div>
</body>
</html>