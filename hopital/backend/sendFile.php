<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

$bdd->sendFile($_POST["id"], $_POST["filename"], $_POST["content"]);
