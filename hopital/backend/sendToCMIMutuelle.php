<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

if (isset($_POST["idLigne"])){

	$id = $_POST["idLigne"];
	$tarif = $bdd.getTarif($id);
	if (!$bdd->getPayeDMI($id)) {
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,
			"http://localhost/api/data?id_grauland=value1&date=value2&heure=value3");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


		$output = curl_exec($ch);

		curl_close($ch);
		if ($output) {
			$bdd.setPayeDMI($id);
		}
	}
	if (!$bdd.getPayeMutuelle($id)) {
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,
			"http://localhost/api/data?id_grauland=value1&date=value2&heure=value3");
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