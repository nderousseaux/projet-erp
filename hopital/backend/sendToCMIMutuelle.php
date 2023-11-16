<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

if (isset($_POST["cmi"])){
	if (isset($_POST["content"])) {
		echo json_encode($bdd->sendToCMIMutuelle($_POST["cmi"],
			$_POST["content"]));
	}
	else {
		echo "Erreur: content vide";
	}
}
else {
	echo "Erreur: filename vide";
}