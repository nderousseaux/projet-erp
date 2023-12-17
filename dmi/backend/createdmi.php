<?php
// Script de création du DMI
include_once "AccessBdd.php";

$bdd = new AccessBdd();
// Vérification des paramètres
if (
    isset($_POST["idGroland"]) &&
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["mdp"])
){
    $id = $_POST["idGroland"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $mdp = $_POST["mdp"];
// Creation du DMI
    if ($bdd->finddmi($id) == null) {
        $ret = $bdd->createdmi($id, $nom, $prenom, $mdp);
        echo json_encode(array(0,0));
    }
    else {
        $erreur = [1, "DMI Existant"];
        echo json_encode($erreur);
    }
}
else {
    $erreur = [2, "Erreur : mauvaise forme DMI"];
    echo json_encode($erreur);
}
?>