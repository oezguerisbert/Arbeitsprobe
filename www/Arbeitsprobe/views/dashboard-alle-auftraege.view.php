
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
                    <a href="./alle-auftraege.php" class="fas fa-sync-alt fa-2x align-self-end text-decoration-none"></a>
                    <a href="./" class="fas fa-compass fa-2x align-self-end ml-3 text-decoration-none"></a>
                    <a href="../logout.php" class="fas fa-sign-out-alt fa-2x ml-3 align-self-end text-decoration-none"></a>
                </div>
            </div>
            <h2>Dashboard </h2>
            <?php

            if (sizeof($tasks) < 1) {
                echo "<div class=\"mt-5 col-md-12 p-4 vw-100 border bg-light rounded\" style=\"border-color:#bfc0c0;\">
                            <div class=\"p-2 text-center\" style=\"color:#7f7f7f;\">Keine Aufträge, <a href='./alle-auftraege.php'>neu laden?</a></div>
                        </div>";
            } else {
                ?>
                <div class="row row-cols-3  pl-3 pr-3 justify-content-around">
                    <table class="table col-12 table-bordered table-hover table-striped table-light">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Benutzername</th>
                            <th scope="col">Cart</th>
                            <th scope="col">Priorität</th>
                            <th scope="col">Anzahl</th>
                            <th scope="col">Admin / Moderator</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                            foreach ($tasks as $key => $task) {
                                ?>
                                <tr style="cursor: pointer;background:<?=$task->getPriority()->getColor()?>" onclick="location.href= './auftrag.php?id=<?=$task->getID()?>'";>
                                    <th scope="row"><?=$task->getID()?></th>
                                    <td><?=$task->getUser()->getUsername()?></td>
                                    <td><?=$task->getCart()->getID()?></td>
                                    <td><?=$task->getPriority()->getKuerzel()?> - <?=$task->getPriority()->getDays()?> Tage</td>
                                    <td><?=$task->getAmount()?>x</td>
                                    <td><?=$task->getModerator() != null ? "@" . $task->getModerator()->getUsername() : "<span style='color:gray;font-style:italic;'>not claimed</span>"?></td> 
                                </tr>
                                <?php
                            }
                            ?>
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