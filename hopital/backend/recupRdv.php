<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

// Vérifie le type de rendez-vous à récupérer dans la bdd
if ($_POST["typeRdv"] === "prevus") {
	echo json_encode($bdd->getRdvPrevus());
}
elseif ($_POST["typeRdv"] === "confirmes") {
	echo json_encode($bdd->getRdvConfirmes());
}
elseif ($_POST["typeRdv"] === "passes") {
	echo json_encode($bdd->getRdvPasses());
}
else {
	echo "Erreur: Type de rendez-vous inconnu";
}