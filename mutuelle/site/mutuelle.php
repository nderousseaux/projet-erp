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
$DB='../data/mutuelle.txt';

function grep($id,$dbfile)
{
  #return shell_exec('grep -e "^[0-9\/]* '.$id.' " '.$file);
  $handle = fopen($dbfile, "r");
  if ($handle) {
      while (($line = fgets($handle)) !== false) {
          echo '<div>'.$line.'</div>';
      }
  
      fclose($handle);
  }

}
$NUIG=htmlspecialchars($_GET["nuig"]);
echo grep($NUIG,$DB);
?>
  <div id = "liste"></div>
</body>
</html>