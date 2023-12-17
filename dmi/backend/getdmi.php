<?php
// Script retournant le dmi complet
include_once "AccessBdd.php";

$bdd = new AccessBdd();
// Vérification des paramètres
if (
    isset($_POST["idGroland"])
){
    $id = $_POST["idGroland"];

    $ret = $bdd->getActes($id);
    if ($ret == null) {
        echo json_encode(null);
    }
    else {
        echo json_encode($ret);
    }
}
else {
    echo json_encode(null);
}
?>