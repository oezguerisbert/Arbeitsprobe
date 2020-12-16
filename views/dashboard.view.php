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
                    <a href="./dashboard.php" class="fas fa-sync-alt fa-2x align-self-end text-decoration-none"></a>
                    <a href="./index.php" class="fas fa-home fa-2x align-self-end ml-3 text-decoration-none"></a>
                    <a href="./logout.php" class="fas fa-sign-out-alt fa-2x ml-3 align-self-end text-decoration-none"></a>
                </div>
            </div>

            <?php

if (sizeof($auftraege) < 1) {
    echo "<div class=\"mt-5 col-md-12 p-4 vw-100 border bg-light rounded\" style=\"border-color:#bfc0c0;\">
                <div class=\"p-2 text-center\" style=\"color:#7f7f7f;\">Keine Aufträge, <a href='dashboard.php'>neu laden?</a></div>
            </div>";
} else {
    ?>
            <h2>Dashboard</h2>
            <div class="row row-cols-3  pl-3 pr-3 justify-content-around">
            <table class="table col-12 table-bordered table-hover table-striped table-light">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Benutzername</th>
                    <th scope="col">Service</th>
                    <th scope="col">Priorität</th>
                </tr>
                </thead>
                <tbody>
                <?php printAuftraege();?>
                </tbody>
            </table>
            </div>
            <?php

}
?>
            <div class="row p-5"></div>
        </div>
    </div>
</body>
</html>