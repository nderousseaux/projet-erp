<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

// Vérifie le type de rendez-vous à récupérer dans la bdd
if (is_numeric($_POST["id"])) {
	echo json_encode($bdd->confirmerRdv($_POST["id"]));
}
else {
	echo "Erreur: ID n'est pas un nombre";
}