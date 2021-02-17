<?php
if (!isset($_SESSION['userid'])) {
    header("Location :/login.php");
}
if (isset($_POST['delete'])) {
    CartRepository::findByUser(intval($_SESSION['userid']))->removeItem(intval($_POST['delete']));
}
$sent = false;
if (isset($_POST['send'])) {
    $cart = CartRepository::findByUser(intval($_SESSION['userid']));
    if ($cart) {
        $sent = $cart->submit(PriorityRepository::findByKuerzel($_POST['prio'])->getID(), date("Y-m-d", strtotime($_POST['date'])));
    }

}
