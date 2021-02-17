<?php
session_start();
require_once __DIR__ . '/incs/requirements.func.inc.php';
if (isset($_GET['withReset'])) {
    DB::testing();
}
?>
<title>KXI-Service | Testing</title>
<?php
print "<pre>";
$user = UserRepository::checkLogin(array(":username" => "admin", ":password" => hash("sha256", "admin")));
if ($user) {
    print "User admin loggedin<br />";
    $cart = CartRepository::findByUser($user->getID());
    if (!$cart) {
        CartRepository::create(array(":userid" => $user->getID()));
        $cart = CartRepository::findByUser($user->getID());
        print "Created cart<br />";
        var_dump($cart);
    }
    $item1 = array(
        ":firstname" => "Max",
        ":lastname" => "Mustermann",
        ":gender" => "male",
        ":height" => 190,
        ":birthdate" => date("Y-m-d", strtotime("01.01.1980")),
        ":serviceid" => ServiceRepository::findByKuerzel("goofy")->getID(),
    );
    $item2 = array(
        ":firstname" => "Özgür",
        ":lastname" => "Isbert",
        ":gender" => "male",
        ":height" => 172,
        ":birthdate" => date("Y-m-d", strtotime("13.05.1996")),
        ":serviceid" => ServiceRepository::findByKuerzel("slalom")->getID(),
    );
    $item3 = array(
        ":firstname" => "Julia",
        ":lastname" => "Freier",
        ":gender" => "female",
        ":height" => 160,
        ":birthdate" => date("Y-m-d", strtotime("01.01.1986")),
        ":serviceid" => ServiceRepository::findByKuerzel("amc")->getID(),
    );
    $addedItem1 = $cart->addItem($item1);
    $addedItem2 = $cart->addItem($item2);
    $addedItem3 = $cart->addItem($item3);

    if ($addedItem1 && $addedItem2 && $addedItem3) {
        print "Added 3 items.";
        $items = $cart->getItems();
        var_dump($items);
    }

    // $x = $cart->updateItem($items[0]->getID(), $item2);
    // if($x){
    //     print "Updated item. (cartitemid: ".$items[0]->getID().")";
    // }
    // $items = $cart->getItems();
    // var_dump($items[0]);
    $cart->submit(PriorityRepository::findByKuerzel('tief')->getID(), date("Y-m-d"));
}
print "</pre>";
