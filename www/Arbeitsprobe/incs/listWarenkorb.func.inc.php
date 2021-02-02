<?php

function listWarenkorb()
{
    $items = CartItemRepository::findByUser(intval($_SESSION['userid']));

    if (count($items) == 0) {
        echo "<div class='col-12 bg-light m-auto p-5' style='text-align:center;border-radius:3px;border:1px solid rgba(0,0,0,0.1);'>
        Kein Warenkob gefunden. <a href='./cart.php?new'>Neu erstellen?</div></div>";
    }
}
