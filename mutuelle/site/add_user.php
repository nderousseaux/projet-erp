<?php

if (!(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["nuig"]) && isset($_POST["mdp"]))) {
	$erreur = array("Erreur", "Infos manquantes dans la requete");
	echo json_encode($erreur);
	exit();
}

$nom    = $_POST["nom"];
$prenom = $_POST["prenom"];
$nuig   = $_POST["nuig"];
$mdp    = $_POST["mdp"];

$str = "$nom $prenom $nuig $mdp\n";

$file = fopen("../data/utilisateurs.txt", "a");
fwrite($file, $str);

?>