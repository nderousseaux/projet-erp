<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="style/style-mutuelle.css">
  <script src="script.js"></script>
</head>
<body>
  <h1>Bienvenue - la mutuelle</h1>
<?php
echo 'Bonjour '.htmlspecialchars($_GET["nuig"]).'!';
?>
  <div id = "liste"></div>
</body>
</html>
