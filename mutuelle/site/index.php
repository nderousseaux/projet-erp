<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="style/style-connexion.css">
  <script src="script.js"></script>
</head>
<body>
  <form action="./mutuelle.html" method="post">
  <ul>
    <li>
      <label for="id">Numéro Unique d’identifiant Graulandais &nbsp;:</label>
      <input type="text" id="id" name="user_id" />
    </li>
    <li>
      <label for="mdp">Mot de passe&nbsp;:</label>
      <input id="mdp" name="user_mdp"></input>
    </li>
  </ul>
  <div class="button">
    <button type="submit">Connexion</button>
  </div>
</form>
</body>
</html>
