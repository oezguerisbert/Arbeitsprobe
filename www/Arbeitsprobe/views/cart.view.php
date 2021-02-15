<?php
require_once __DIR__ . '/../incs/listWarenkorb.func.inc.php';
require_once __DIR__ . '/../incs/createPriorities.func.inc.php';
require_once __DIR__ . '/../incs/createAlert.func.inc.php';
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

            <div class="row justify-content-around">
                <?php
                if($_SERVER['REQUEST_METHOD'] !== "POST"){
                    $cart = CartRepository::findByUser(intval($_SESSION['userid']));
                    if(!$cart){
                        CartRepository::create(array(":userid" => intval($_SESSION['userid'])));
                        $cart = CartRepository::findByUser(intval($_SESSION['userid']));
                    }
                    $items = $cart->getItems();
                    if(count($items) == 0){
                        echo "<div class='col-12 bg-light m-auto p-5' style='text-align:center;border-radius:3px;border:1px solid rgba(0,0,0,0.1);'>
                        Keine Items im Warenkorb. Möchten sie <a href='./index.php#products'>neue hinzufügen?</a>
                        </div>";
                    }else {
                    ?>
                    <form action="./cart.php" method="POST" class="w-100">
                        <table class="table col-12 table-bordered table-hover table-striped table-light">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Firstname</th>
                                <th scope="col">Lastname</th>
                                <th scope="col">Height</th>
                                <th scope="col">Service</th>
                                <th scope="col">Birthdate</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($items as $i => $item) {
                                    ?>
                                        <tr>
                                            <td><?=$item->getFirstname()?></td>
                                            <td><?=$item->getLastname()?></td>
                                            <td><?=$item->getHeight()?> cm</td>
                                            <td><?=$item->getService()->getKuerzel()?></td>
                                            <td><?=date("m.d.Y", strtotime($item->getBirthdate()))?></td>
                                            <td><button name="delete" value="<?=$item->getID()?>" type="submit" class="btn fa fa-trash" style="color:red"></button></td>
                                        </tr>
                                    <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </form>
                    <form action="./cart.php" method="POST">
                        <?php $prios = PriorityRepository::findAll();?>
                        <?=createPriorities($prios, $_POST['prio'] ?? "", true);?>
                        <br />
                        <button class="btn btn-primary" name="send">Abschicken!</button>
                    </form>
                    <?php
                    }
                }else {
                    if($sent){
                        echo createAlert("success", "Cart", array("Items got added"), false);
                    }else {
                        echo "<div class='col-12 bg-light m-auto p-5' style='text-align:center;border-radius:3px;border:1px solid rgba(0,0,0,0.1);'>
                        Keine Items im Warenkorb. Möchten sie <a href='./index.php#products'>neue hinzufügen?</a>
                        </div>";
                    }
                }
                
                ?>
            </div>
            <div class="row p-2 display-flex align-items-end">
                
            </div>
        </div>
        <?php include __DIR__ . '/../incs/footer.inc.php';?>
    </div>
</body>
</html>