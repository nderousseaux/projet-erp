<?php
// Script de vérification de l'identifiant et du mot de passe
include_once "AccessBdd.php";

$bdd = new AccessBdd();
// Vérification des paramètres
if (
    isset($_POST["id"]) &&
    isset($_POST["password"])
){
    $id = $_POST["id"];
    $pwd = $_POST["password"];

    $ret = $bdd->checkconnect($id, $pwd);
    // Couple non existant
    if ($ret == 0) {
        echo json_encode(1);
    }
    else {
        echo json_encode(0);
    }
}
else {
    $erreur = "Erreur : champ(s) non renseigné(s)";
    echo json_encode($erreur);
}
?>