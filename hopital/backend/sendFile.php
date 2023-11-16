<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

if (is_numeric($_POST["id"])) {
    if (isset($_POST["filename"])){
        if (isset($_POST["content"])) {
	        echo json_encode($bdd->sendFile($_POST["id"], $_POST["filename"], $_POST["content"]));
        }
        else
            echo "Erreur: content vide";
    }
    else {
	    echo "Erreur: filename vide";
    }
}
else {
	echo "Erreur: ID n'est pas un nombre";
}