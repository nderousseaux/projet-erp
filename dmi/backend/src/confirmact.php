<?php
// Script permettant de confirmer un acte
include_once "AccessBdd.php";

$bdd = new AccessBdd();
// Vérification des paramètres
if (
    isset($_POST["idActe"])
){
    $id = $_POST["idActe"];
    // Check si l'acte existe
    if ($bdd->getActe($id) == null) {
        echo json_encode(array(1, "Acte non existant"));
    }
    else {
        $bdd->confirmAct($id);
        // CONTACTER MUTUELLE ? HOPITAL ?
        echo json_encode(array(0, $id));
    }
}
else {
    $erreur = "Erreur : id acte reconnu";
    echo json_encode(array(1, $erreur));
}
?>