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
        <div class="col pt-4 pb-4">
            <div class="row pl-3 pr-3 d-flex">
                <h1>KXI</h1>
                <div class="ml-auto options d-flex pt-3 pb-3">
                    <a href="./" class="fas fa-sync-alt fa-2x align-self-end text-decoration-none"></a>
                    <a href="../index.php" class="fas fa-home fa-2x align-self-end ml-3 text-decoration-none"></a>
                    <a href="../logout.php" class="fas fa-sign-out-alt fa-2x ml-3 align-self-end text-decoration-none"></a>
                </div>
            </div>
            <h2>Dashboard</h2>
            <div class="row row-cols-3 pl-3 pr-3 justify-content-start">
                <a href="./meine-auftraege.php" class="col-2 card p-2 mr-2"><div class="">My Tasks</div></a>
                <a href="./alle-auftraege.php" class="col-2 card p-2 mr-2"><div class="">All Tasks</div></a>
                <a href="./nutzer.php" class="col-2 card p-2 mr-2"><div class="">Users</div></a>
            </div>

            <div class="row p-5"></div>
        </div>
    </div>
</body>
</html>