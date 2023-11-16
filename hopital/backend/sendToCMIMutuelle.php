<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

$bdd->envoieVersCMIMutuelle($_POST["cmi"], $_POST["content"]);