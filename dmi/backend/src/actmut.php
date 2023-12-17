<?php
// Script permettant de faire payer la mutuelle
include_once "AccessBdd.php";

$bdd = new AccessBdd();
// Vérification des paramètres
if (
    isset($_POST["id"]) &&
    isset($_POST["intervention"])
){
    $id_grld = $_GET["id"];
    $inter = $_GET["intervention"];

    $ret = $bdd->findact($id_grld, $inter);
    // On cherche l'acte pour
    if (mysql_num_rows($ret) == 0) {
        echo json_encode(array(1, "Acte non existant"));
    }
    else {
        $idact = intval($ret["id"]);
        echo json_encode(array(0, $idact));
    }
}
else {
    $erreur = "Erreur : id acte reconnu";
    echo json_encode(array(1, $erreur));
}
?>