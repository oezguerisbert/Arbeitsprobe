<?php
// require_once './classes/DB.class.php';
// require_once './repositories/Service.repo.php';
// require_once './repositories/User.repo.php';
// require_once './classes/User.class.php';

/**
 * Erstellt die Logout(+Dashboard)/Login-Buttons
 */
function printUserOptions()
{
    if (!isset($_SESSION['userid'])) {
        ?>
        <a href="./login.php" class="fas fa-sign-in-alt fa-2x align-self-end text-decoration-none"></a>
        <?php
} else {
        $user = UserRepository::find($_SESSION['userid']);
        $opacity = 0.5;

        if ($user) {
            $usertype = $user->getUsertype();
            $ml = "ml-auto";
            echo "<a href=\"./cart.php\" class=\"fas fa-shopping-cart fa-2x align-self-end text-decoration-none mr-3\" style=\"opacity:$opacity\"></a>";
            if (in_array($usertype, User::getSupervisedUsertypes())) {
                echo "<a href=\"./dashboard\" class=\"fas fa-compass fa-2x align-self-end text-decoration-none\"></a>";
                $ml = "ml-3";
            }
            echo "<a href=\"./logout.php\" class=\"fas fa-sign-out-alt fa-2x $ml align-self-end text-decoration-none\"></a>";
        } else {
            echo "<a href=\"./login.php\" class=\"fas fa-sign-in-alt fa-2x align-self-end text-decoration-none\"></a>";
        }

    }
}