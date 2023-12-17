<?php
// Script de création d'un acte
include_once "AccessBdd.php";

$bdd = new AccessBdd();
// Vérification des paramètres
if (
    isset($_GET["idGroland"]) &&
    isset($_GET["idActe"]) &&
    isset($_GET["lieu"]) &&
    isset($_GET["type"]) &&
    isset($_GET["date"]) &&
    isset($_GET["montant"])
){
    $id_grld = urldecode($_GET["idGroland"]);
    $idacte = urldecode($_GET["idActe"]);
    $lieu = urldecode($_GET["lieu"]);
    $type = urldecode($_GET["type"]);
    // Format date 'YYYY-MM-DD HH:MI:SS'
    $date = urldecode($_GET["date"]);
    $montant = floatval(urldecode($_GET["montant"]));
    // Peut etre null
    $notes = urldecode($_GET["notes"]);

    // Creation du DMI
    $ret = $bdd->createacte($idacte, $id_grld, $lieu, $type, $date, $notes,
    $montant);
    // Si succès on retourne 0, 1 sinon
    if ($ret) {
        echo json_encode(array(0));
    }
    else {
        echo json_encode(array(1, "le DMI existe déjà"));
    }
}
else {
    $erreur = [2, "Erreur : mauvais format création acte"];
    echo json_encode($erreur);
}
?>