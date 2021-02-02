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
                <div class='card-img-top' style='height:150px;background-image:url(\"$imageLink\");background-size:cover;background-position:center;'></div>
                <div class='card-body' style='height:auto;'>
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
