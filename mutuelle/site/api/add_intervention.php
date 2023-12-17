<?php

/**
 * Appele par l'hopital pour informer mutuelle d'une nouvelle intervention
 */

if (!(isset($_GET["date"]) && 
	isset($_GET["nuig"]) && 
	isset($_GET["intervention"]) && 
	isset($_GET["commentaire"]) && 
	isset($_GET["lieu"]) && 
	isset($_GET["total"]) && 
	isset($_GET["paye"]))) {

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
$paye           = urldecode($_GET["paye"]);			// montant paye par hopital
$reste          = $total - $paye;					// reste a charge apres prise en charge de hopital

$pec        = 40;               			// prise en charge 40% par défaut
$virement   = $total * $pec/100;			// somme prise en charge par mutuelle ( % du total de l'intervention, a verser a hopital)


$str = "$date $nuig $intervention $commentaire $lieu $total $virement $pec\n";

$file = fopen("../data/mutuelle.txt", "a");
fwrite($file, $str);


// TODO envoyer confirmation au DMI

?>