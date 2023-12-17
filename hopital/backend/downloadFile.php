<?php
include_once "AccesBdd.php";

$bdd = new AccesBdd();

if (is_numeric($_POST["id"])) {
        echo json_encode($bdd->downloadFile($_POST["id"]));
} else {
        echo "ID pas un nombre";
}

