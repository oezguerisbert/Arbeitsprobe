<?php
require_once './classes/DB.class.php';
require_once './repositories/Service.repo.php';
require_once './repositories/User.repo.php';
require_once './classes/User.class.php';
function printUserOptions(){
    if (!isset($_SESSION['userid'])) {
        ?>
        <a href="./login.php" class="fas fa-sign-in-alt fa-2x align-self-end text-decoration-none"></a>
        <?php
    } else {
        $user = UserRepository::find($_SESSION['userid']);
        if ($user) {
            $usertype = $user->getUsertype();
            $ml = "ml-auto";
            if (in_array($usertype, User::getSupervisedUsertypes())) {
                echo "<a href=\"./dashboard.php\" class=\"fas fa-compass fa-2x align-self-end text-decoration-none\"></a>";
                $ml = "ml-3";
            }
            echo "<a href=\"./logout.php\" class=\"fas fa-sign-out-alt fa-2x $ml align-self-end text-decoration-none\"></a>";
        } else {
            echo "<a href=\"./login.php\" class=\"fas fa-sign-in-alt fa-2x align-self-end text-decoration-none\"></a>";
        }
    
    }
}