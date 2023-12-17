<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

define("PORT_DMI", "3001");
define("PORT_MUTUELLE", "3002");

$id = null;

// Vérifie si le formulaire est vide
if (isset($_POST["idLigne"])) {
	$id = $_POST["idLigne"];
}
else {
	echo "Erreur: idLigne non spécifié";
}
if (isset($_POST["entite"])) {
	$entite = $_POST["entite"];
}
else {
	echo "Erreur: entite non spécifié";
}

// Détermine le nom du fichier backend
if ($entite === "dmi") {
	$nomFichierBakend = "backend/src/createact.php";
	$port = PORT_DMI;
}
else if ($entite === "mutuelle") {
	$nomFichierBakend = "api/add_intervention.php";
	$port = PORT_MUTUELLE;
}
else {
	echo "Erreur: entite non reconnue";
}

// Récupère les informations
$idGrauland = $bdd->getIdGrauland($_POST["idLigne"]);
$lieu = "Strasbourg";
$examen = $bdd->getExamen($id);
$date = $bdd->getDate($id);
$montant = $bdd->getMontant($id);

// Forge l'url
$url = "http://localhost:";
$url = $url . urlencode($port) . "/";
$url = $url . urlencode($nomFichierBakend);
$url = $url . "?nuig=" . urlencode($idGrauland);
$url = $url . "&lieu=" . urlencode($lieu);
$url = $url . "&intervention=" . urlencode($examen);
$url = $url . "&date=" . urlencode($date);
$url = $url . "&total=" . urlencode($montant);

// Ajoute le commentaire si c'est une mutuelle
if ($entite === "dmi") {
	$url = $url . "&id_acte=" . urlencode($_POST["idExam"]);
}
else if ($entite === "mutuelle") {
	$url = $url . "&commentaire=" . urlencode($bdd->getMetadata2($id));
}

// Envoie la requête
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);