<?php
// Script permettant de payer un acte d'un certain montant
include_once "AccessBdd.php";

$bdd = new AccessBdd();
// Vérification des paramètres
if (
    isset($_POST["idActe"]) &&
    isset($_POST["montant"])
){
    $id = $_POST["idActe"];
    $montant = floatval($_POST["montant"]);
    // Check si l'acte existe
    if ($bdd->getActe($id) == null) {
        echo json_encode(array(1, "Acte non existant"));
    }
    else {
        $remaining = floatval($bdd->getRemaining($id)["restant"]);
        if ($remaining == 0.0) {
            echo json_encode(array(1, "Le dû est de 0"));
        }
        else if ($remaining < $montant) {
            echo json_encode(array(1, "Le montant est supérieur au dû restant"));
        } 
        else {
          $res = $bdd->pay($id, $montant);
            echo json_encode(array(0, $res));
        }
    }
}
else {
    $erreur = "Erreur : champ(s) non renseigné(s)";
    echo json_encode(array(1, $erreur));
}
?>