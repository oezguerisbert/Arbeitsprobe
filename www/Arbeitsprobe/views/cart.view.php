<?php
require_once __DIR__ . '/../incs/listWarenkorb.func.inc.php';
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
                    <a href="./" class="fas fa-home fa-2x align-self-end ml-3 text-decoration-none"></a>
                    <a href="./logout.php" class="fas fa-sign-out-alt fa-2x ml-3 align-self-end text-decoration-none"></a>
                </div>
            </div>
            <h2>
                Warenkorb
            </h2>

            <div class="row row-cols-3 justify-content-around">
                <?=listWarenkorb();?>
            </div>
            <div class="row p-5"></div>
        </div>
        <?php include __DIR__ . '/../incs/footer.inc.php';?>
    </div>
</body>
</html>