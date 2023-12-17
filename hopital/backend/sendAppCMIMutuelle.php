<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

define("PORT_DMI", "3001");

$id = null;
if (isset($_POST["idLigne"])) {
	$id = $_POST["idLigne"];
}
else {
	echo "Erreur: idLigne non spécifié";
}

$nomFichierBakend = "createact.php";

$idGroland = $bdd->getIdGroland($_POST["idLigne"]);
$lieu = "Strasbourg";
$examen = $bdd->getExamen($id);
$date = $bdd->getDate($id);
$montant = $bdd->getMontant($id);

// Forge l'url
$url = "http://localhost:";
$url = $url . PORT_DMI . "/";
$url = $url . $nomFichierBakend;
$url = $url . "?id_grauland=" . $idGroland;
$url = $url . "&id_acte=" . $id;
$url = $url . "&lieu=" . $lieu;
$url = $url . "&type=" . $examen;
$url = $url . "&date=" . $date;
$url = $url . "&montant=" . $montant;

// Envoie la requête
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$output = curl_exec($ch);
curl_close($ch);





// $id = $_POST["idLigne"];
// 	$idGroland = $bdd->getIdGroland($id);

// 	$num_port = 80;
// 	$tarif = $bdd.getTarif($id);
// 	$url = "http://localhost:";
// 	$url = $url . (string)$num_port;
// 	$url = $url . "/api/data?id_grauland=";


// if (isset($_POST["idLigne"])){
// 	$id = $_POST["idLigne"];
// 	$idGroland = $bdd->getIdGroland($id);

// 	$num_port = 80;
// 	$tarif = $bdd.getTarif($id);
// 	$url = "http://localhost:";
// 	$url = $url . (string)$num_port;
// 	$url = $url . "/api/data?id_grauland=";
	
// 	if (!$bdd->getPayeDMI($id)) {
// 		$ch = curl_init();
// 		$url = $url . (string)$id;
// 		$url = $url . "&tarif=";
// 		$url = $url . (string)($tarif / 2);
// 		curl_setopt($ch, CURLOPT_URL, $url);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// 		$output = curl_exec($ch);

// 		curl_close($ch);
// 		if ($output) {
// 			$bdd.setPayeDMI($id);
// 		}
// 	}
// 	if (!$bdd.getPayeMutuelle($id)) {
		
// 		$ch = curl_init();

// 		$url = $url . (string)$id;
// 		$url = $url . "&tarif=";
// 		$url = $url . (string)($tarif / 2);
// 		curl_setopt($ch, CURLOPT_URL, $url);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// 		$output = curl_exec($ch);

// 		curl_close($ch);
// 		if ($output) {
// 			$bdd.setPayeMutuelle($id);
// 		}
// 	}
// }
// else {
// 	echo "Erreur: idLigne non spécifié";
// }
