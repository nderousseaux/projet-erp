<?php
$ch = curl_init();

// Défini les options de transmission
curl_setopt($ch, CURLOPT_URL,
    "http://localhost/api/data?id_grauland=value1&date=value2&heure=value3");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


$output = curl_exec($ch);

curl_close($ch);

// Stocke les données
$data = json_decode($output, true);