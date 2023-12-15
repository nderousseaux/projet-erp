<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

if (isset($_POST["idLigne"])){

	$id = $_POST["idLigne"];
	$num_port = 80;
	$tarif = $bdd.getTarif($id);
	$url = "http://localhost:";
	$url = $url . (string)$num_port;
	$url = $url . "/api/data?id_grauland=";
	
	if (!$bdd->getPayeDMI($id)) {
		
		$ch = curl_init();
		$url = $url . (string)$id;
		$url = $url . "&tarif=";
		$url = $url . (string)($tarif / 2);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$output = curl_exec($ch);

		curl_close($ch);
		if ($output) {
			$bdd.setPayeDMI($id);
		}
	}
	if (!$bdd.getPayeMutuelle($id)) {
		
		$ch = curl_init();

		$url = $url . (string)$id;
		$url = $url . "&tarif=";
		$url = $url . (string)($tarif / 2);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$output = curl_exec($ch);

		curl_close($ch);
		if ($output) {
			$bdd.setPayeMutuelle($id);
		}
	}
}
else {
	echo "Erreur: idLigne non spécifié";
}
