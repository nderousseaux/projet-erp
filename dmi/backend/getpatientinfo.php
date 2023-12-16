<?php
// Script pour récupérer les données du patient
include_once "AccessBdd.php";

$bdd = new AccessBdd();
// Vérification des paramètres
if (
    isset($_POST["idGroland"])
){
    $id = $_POST["idGroland"];

    $ret = $bdd->finddmi($id);
    if ($ret == null) {
        echo json_encode(array(1, "DMI Inexistant"));
    }
    else {
        echo json_encode(array(0, $ret));
    }
}
else {
    $erreur = "Erreur : id graulandais reconnu";
    echo json_encode($erreur);
}
?>