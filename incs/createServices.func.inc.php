<?php
/**
 * ERstellt Bootstrap-Karten
 *
 * @param string $imageLink bild-url
 * @param string $title titel
 * @param string $description beschreibung
 *
 * @return string HTML
 */
function createCard(string $imageLink, string $title, string $description = "", string $buttonText = "Open", string $cardLink = "")
{
    return "
        <div class='col p-2'>
            <div class='card shadow-md'>
                <img src='$imageLink' class='card-img-top'>
                <div class='card-body' style='min-height:180px;height:auto;'>
                    <h5 class='card-title'>$title</h5>
                    <p class='card-text' style='height:auto;min-height:50px;'>$description</p>
                    <div class='d-flex'>
                        <div class='ml-auto mr-auto'></div>
                        <a href='./formular.php?service=$cardLink' class='btn btn-primary align-self-end'>$buttonText</a>
                    </div>
                </div>
            </div>
        </div>
        ";
}
/**
 * Erstellt eine Service-Rows-Karte
 *
 * @param array $services service-array
 *
 * @return string HTML
 */
function createServices(array $services)
{
    $d = "";
    foreach ($services as $key2 => $value) {
        $d .= createCard(
            $value->getImage(),
            $value->getTitle(),
            $value->getDescription(),
            $value->getPrice() . " CHF",
            $value->getKuerzel()
        );
    }

    return $d;
}
