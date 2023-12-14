<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>La Mutuelle</title>
  <link rel="stylesheet" href="style/style-mutuelle.css">
  <script src="script.js"></script>
</head>
<body>
  <h1>Bienvenue - La Mutuelle</h1>
<?php
$DB='../data/mutuelle.txt';

function grep($id,$dbfile)
{
  #return shell_exec('grep -e "^[0-9\/]* '.$id.' " '.$file);
  $handle = fopen($dbfile, "r");
  if ($handle) {
      echo '<div class="table">';
      while (($line = fgets($handle)) !== false) {
          // Séparer la ligne de la bdd en fonction des espaces
          $elements = explode(' ', $line);

          // On affiche que les éléments qui correspondent à l'utilisateur connecté
          if($elements[1] == $id){    
            // On sait qui on est, du coup on vire l'id
            unset($elements[1]);

            // Création des balises
            echo '<div class="table-row">';
            foreach ($elements as $element) {
              echo '<div class="case">'.$element.'</div>';
              }
            echo '</div>';
          }
      }
      echo '</div>';
  
      fclose($handle);
  }

}
$NUIG=htmlspecialchars($_GET["nuig"]);
echo grep($NUIG,$DB);
?>
  <div id = "liste"></div>
</body>
</html>