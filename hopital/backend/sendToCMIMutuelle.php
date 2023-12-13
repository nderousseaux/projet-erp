<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

if (isset($_POST["idLigne"])){

}
else {
	echo "Erreur: idLigne non spécifié";
}