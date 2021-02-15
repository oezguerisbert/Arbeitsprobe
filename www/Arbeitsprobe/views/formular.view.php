<?php
require_once './incs/createInput.func.inc.php';
require_once './incs/createNumberInput.func.inc.php';
require_once './incs/createSelect.func.inc.php';
require_once './incs/createDateInput.func.inc.php';
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
                <div class="col-8 card p-4">
                    <h1>
                        Service-Formular
                        <br />
                        <?=ServiceRepository::findByKuerzel($service)?>
                    </h1>
                    <div id="infos">
                        <?php printResult();?>
                    </div>
                    <?php if (!isset($db_query_result) || sizeof($errors) > 0) {?>
                        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                            <?=createInput("firstname", (isset($data_ok) && !$data_ok) ? $data["firstname"] : "", "text", null, true);?>
                            <?=createInput("lastname", (isset($data_ok) && !$data_ok) ? $data["lastname"] : "", "text", null, true);?>
                            <?=createNumberInput("height", (isset($data_ok) && !$data_ok) ? $data["height"] : "", array("min" => null, "max" => null), null, true);?>
                            <?=createDateInput("birthdate", (isset($data_ok) && !$data_ok) ? $data["birthdate"] : "", array("min" => null, "max" => strtotime("today")), null, true);?>
                            <?=createSelect("gender", (isset($data_ok) && !$data_ok) ? $data["gender"] : "", array("male", "female", "other"), null, true);?>
                            <br />
                            <div class="row display-flex">
                                <div class="col-lg-8 align-self-start">
                                    <a class="btn btn-secondary" href="javascript:history.back()">zurück</a>
                                </div>
                                <div class="col col-lg-4">
                                    <button class="btn btn-primary float-right" type="submit">In den Warenkorb</button>
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