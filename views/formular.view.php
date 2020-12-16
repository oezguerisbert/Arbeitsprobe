<?php
require_once './incs/createInput.func.inc.php';
require_once './incs/createPriorities.func.inc.php';
require_once './incs/createAlert.func.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kxi-Service</title>
    <?php
include './incs/bootstrap.head.inc.php';
?>
</head>
<body>
    <div class="container">
        <div class="col pt-4 pb-4">
            <div class="row">
                <div class="col"></div>
                <div class="col-8">
                    <h1>
                        Service-Formular
                        <br />
                        <?=ServiceRepository::findByKuerzel($service)?>
                        <?=(isset($prio) ? PriorityRepository::findByKuerzel($prio) : "")?>
                    </h1>
                <div id="infos">
                    <?php printResult();?>
                </div>
                <?php if (!isset($db_query_result) || sizeof($errors) > 0) {?>
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <h5>Wählen sie eine Priorität aus</h5>
                        <?=createPriorities(PriorityRepository::findAll(), isset($prio) ? $prio : "");?>
                        <br />
                        <div class="row">
                            <div class="col-lg-10">
                                <a class="btn btn-secondary" href="javascript:history.back()">zurück</a>
                            </div>
                            <div class="col-lg-2">
                                <button class="btn btn-primary align-self-end" type="submit">Senden</button>
                            </div>
                        </div>
                    </form>
                <?php }?>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </div>
</body>
</html>