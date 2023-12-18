<?php
// Script permettant de payer un acte d'un certain montant
include_once "AccessBdd.php";

$bdd = new AccessBdd();
// Vérification des paramètres
if (
    isset($_GET["idActe"]) &&
    isset($_GET["montant"])
){
    $id = $_GET["idActe"];
    $montant = floatval($_GET["montant"]);
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
        // Contacter l'hopital pour valider le paiement
        else if ($remaining == $montant) {
            $res = $bdd->pay($id, $montant);
            
            $url = 'http://localhost:3003/backend/confirmPayment.php';

            // Création de l'URL avec les paramètres
            $params = array(
                'idActe' => $id,
                'entite' => 'dmi'
            );

            $url .= '?' . http_build_query($params); // Ajout des paramètres à l'URL

            // Initialisation de cURL
            $curl = curl_init($url);

            // Configuration de la requête cURL
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPGET, true);

            // Exécution de la requête cURL
            $response = curl_exec($curl);
            
            // Fermeture de la session cURL
            curl_close($curl);
            echo json_encode(array(0,0));
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
