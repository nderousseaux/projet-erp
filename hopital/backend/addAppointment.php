<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

// Vérifie si le formulaire est vide
if (
	is_numeric($_POST["idGrauland"]) &&
	is_string($_POST["dateHeure"]) &&
	is_string($_POST["examen"]) &&
	is_string($_POST["lieu"]) &&
	is_string($_POST["patient"]) &&
	is_string($_POST["metadata1"]) &&
	is_string($_POST["metadata2"]) &&
	is_numeric($_POST["montant"])
){
	$idGrauland = $_POST["idGrauland"];
	$dateHeure = $_POST["dateHeure"];
	$examen = $_POST["examen"];
	$lieu = $_POST["lieu"];
	$patient = $_POST["patient"];
	$metadata1 = $_POST["metadata1"];
	$metadata2 = $_POST["metadata2"];
	$montant = $_POST["montant"];

	$idExam = $bdd->newAppointment($idGrauland, $dateHeure, $examen, $lieu,
		$patient, $metadata1, $metadata2, $montant);

	// Envoie l'id de l'examen au client
	echo $idExam;
}
else {
	echo "Erreur: Formulaire mal formé";
}
