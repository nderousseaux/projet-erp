<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

// Vérifie le type de rendez-vous à récupérer dans la bdd
if (is_numeric($_POST["id"])) {
	$retour = $bdd->confirmAppointment($_POST["id"]);

	// Récupère les informations
	$nomFichierBakend = "api/confirm_rdv.php";
	$id = $_POST["id"];

	// Forge l'url
	$url = "http://dmi/";
	$url = $url . $nomFichierBakend;
	$url = $url . "?id=" . urlencode($id);

	// Envoie la requête
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);

	echo json_encode($retour);
}
else {
	echo "Erreur: ID n'est pas un nombre";
}