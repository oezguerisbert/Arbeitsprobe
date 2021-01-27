<?php
include_once './incs/checkInput.func.inc.php';
include_once './repositories/User.repo.php';
include_once './classes/DB.class.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KXI-Service - Login</title>
    <?php
include './incs/bootstrap.head.inc.php';
?>
</head>
<body>
    <div class="container pt-5">
        <div class="col-md-6 m-auto">
            <div class="col ">
                <?php printResult();?>
            </div>
            <?php
if (isset($login_blocked) && !$login_blocked) {
    ?>
<div class="col">
<form class="col align-items-center" action="login.php<?=(isset($_GET['redirect']) ? "?redirect=" . $_GET['redirect'] : "")?> " method="POST">
    <?=createInput("username", $_POST['username'] ?? "", "text", null, true);?>
    <?=createInput("password", $_POST['password'] ?? "", "password", null, true);?>
    <div class="col d-flex p-0">
        <button type="submit" class="btn ml-auto btn-primary">Login</button>
    </div>
    <div class="col d-flex p-0 mt-3">
        <a href="index.php" class="btn btn-secondary">Back to Front</a>
        <a href="register.php<?php echo isset($_GET['redirect']) ? "?redirect=" . $_GET['redirect'] : ""; ?>" class="btn ml-2 mr-auto btn-success">Register</a>
    </div>
</form>
</div>
<?php
}
?>

        </div>
    </div>
</body>
</html>