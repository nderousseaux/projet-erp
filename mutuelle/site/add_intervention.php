<?php

if (!(isset($_POST["date"]) && isset($_POST["nuig"]) && isset($_POST["intervention"]) && isset($_POST["commentaire"]) && isset($_POST["lieu"]) && isset($_POST["prix"]))) {
	$erreur = array("Erreur", "Infos manquantes dans la requete");
	echo json_encode($erreur);
	exit();
}

$date           = $_POST["date"];
$nuig           = $_POST["nuig"];
$intervention   = $_POST["intervention"];
$commentaire    = $_POST["commentaire"];
$lieu           = $_POST["lieu"];
$prix           = $_POST["prix"];

$pec        = 40;               # qui def % pris en charge ?
$virement   = $prix * $pec/100;


$str = "$date $nuig $intervention $commentaire $lieu $prix $virement $pec\n";

$file = fopen("../data/mutuelle.txt", "a");
fwrite($file, $str);

?>