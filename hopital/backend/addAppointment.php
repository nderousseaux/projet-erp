<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

// Vérifie si le formulaire est vide
if (
	is_numeric($_POST["idGroland"]) &&
	is_string($_POST["dateHeure"]) &&
	is_string($_POST["examen"]) &&
	is_string($_POST["patient"]) &&
	is_string($_POST["metadata1"]) &&
	is_string($_POST["metadata2"]) &&
	is_string($_POST["mutuelle"]) &&
	is_numeric($_POST["montant"])
){
	$idGroland = $_POST["idGroland"];
	$dateHeure = $_POST["dateHeure"];
	$examen = $_POST["examen"];
	$patient = $_POST["patient"];
	$metadata1 = $_POST["metadata1"];
	$metadata2 = $_POST["metadata2"];
	$mutuelle = $_POST["mutuelle"];
	$montant = $_POST["montant"];

	$idExam = $bdd->newAppointment($idGroland, $dateHeure, $examen, $patient,
		$metadata1, $metadata2, $mutuelle, $montant);

	// Envoie l'id de l'examen au client
	echo $idExam;
}
else {
	echo "Erreur: Formulaire mal formé";
}
