<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

echo json_encode($bdd->getFiles($_POST["id"]));
