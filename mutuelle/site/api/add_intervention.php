<?php

/**
 * Appele par l'hopital pour informer mutuelle d'une nouvelle intervention
 * Envoie une reponse a hopital pour confirmer prise en charge d'une partie des frais
 * Envoie au DMI le montant pris en charge
 */

if (!(isset($_GET["date"]) && 
	isset($_GET["nuig"]) && 
	isset($_GET["intervention"]) && 
	isset($_GET["commentaire"]) && 
	isset($_GET["lieu"]) && 
	isset($_GET["total"]) && 
	isset($_GET["id_acte"])
	)) {

	$erreur = array("Erreur", "Infos manquantes dans la requete");
	echo json_encode($erreur);
	exit();
}

$date           = urldecode($_GET["date"]);			// DD/MM/YY
$nuig           = urldecode($_GET["nuig"]);			// Numero Unique d'Identifiant Graulandais
$intervention   = urldecode($_GET["intervention"]);
$commentaire    = urldecode($_GET["commentaire"]);
$lieu           = urldecode($_GET["lieu"]);
$total          = urldecode($_GET["total"]);		// cout total de l'intervention
$id_acte		= urldecode($_GET["id_acte"]);		// montant paye par hopital

$pec        = 50;					// prise en charge 50% par défaut
$virement   = $total * $pec/100;	// somme prise en charge par mutuelle ( % du total de l'intervention, a verser a hopital)


$str = "$date $nuig $intervention $commentaire $lieu $total $virement $pec\n";

$file = fopen("../../data/mutuelle.txt", "a");
fwrite($file, $str);
fclose($file);

// Envoi de la confirmation a hopital
$id_acte = urlencode($id_acte);
$url = "http://hopital:3003/backend/confirmPayment.php?entite=mutuelle&idActe=$id_acte";
// echo "curl -G \"$url\"";
// shell_exec("curl -G \"$url\"");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);

// Envoi du montant pris en charge au DMI
// $nuig 			= urlencode($nuig);
// $intervention 	= urlencode($intervention);

// // $url = "http://localhost:80/backend/actmut.php?id=$nuig&intervention=$intervention";
// $url = "http://localhost:3001/backend/actmut.php?id=$nuig&idActe=$id_acte";

// $response = file_get_contents($url);

// echo $response;


?>