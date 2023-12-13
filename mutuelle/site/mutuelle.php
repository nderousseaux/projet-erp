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
$DB="../data/mutuelle";

function grep($id,$file)
{
  return shell_exec('grep -e "^[0-9\/]* '.$id.' " '.$file);
}
$NUIG=htmlspecialchars($_GET["nuig"]).'!';
echo grep($NUIG,$DB)
?>
  <div id = "liste"></div>
</body>
</html>
