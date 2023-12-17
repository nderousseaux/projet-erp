<?php
// Script de création d'un acte
include_once "AccessBdd.php";

$bdd = new AccessBdd();
// Vérification des paramètres
if (
	isset($_GET["idActe"]) &&
	isset($_GET["entite"])
){
	$idacte = urldecode($_GET["idActe"]);
	$entite = urldecode($_GET["entite"]);

	if ($entite === "dmi") {
		$bdd->setPayeDMI($idacte);
	}
	else if ($entite === "mutuelle") {
		$bdd->setPayeMutuelle($idacte);
	}
	else {
		echo "Erreur: entite non reconnue";
	}
}
else {
	echo "Erreur: arguments manquants";
}