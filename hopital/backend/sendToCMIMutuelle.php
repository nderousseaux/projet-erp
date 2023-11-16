<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

$bdd->sendToCMIMutuelle($_POST["cmi"], $_POST["content"]);