<?php 
function listAuftraege(){
    return "<table class=\"table col-12 table-bordered table-hover table-striped table-light\">
        <thead class=\"thead-light\">
            <tr>
                <th scope=\"col\">#</th>
                <th scope=\"col\">Benutzername</th>
                <th scope=\"col\">Service</th>
                <th scope=\"col\">Priorität</th>
            </tr>
        </thead>
        <tbody>
        ".printAuftraege()."
        </tbody>
    </table>";
}