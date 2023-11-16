<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();


if (is_numeric($_POST["id"])) {
	echo json_encode($bdd->getFiles($_POST["id"]));
}
else {
	echo "Erreur: ID n'est pas un nombre";
}