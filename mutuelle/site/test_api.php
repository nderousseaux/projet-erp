<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  <link rel="stylesheet" href="style/style-connexion.css">
  <script src="script.js"></script>
</head>
<body>
  <h1>add_user</h1>
  <form action="./api/add_user.php" method="get">
    <ul>
      <li>
        <label for="id">nom &nbsp;:</label>
        <input type="text" id="id" name="nom" />
      </li>
      <li>
        <label for="id">prenom &nbsp;:</label>
        <input type="text" id="id" name="prenom" />
      </li>
      <li>
        <label for="id">Numéro Unique d’identifiant Graulandais &nbsp;:</label>
        <input type="text" id="id" name="nuig" />
      </li>
      <li>
        <label for="mdp">Mot de passe&nbsp;:</label>
        <input id="mdp" name="mdp"></input>
      </li>
    </ul>
    <div class="button">
      <button type="submit">send</button>
    </div>
  </form>

  <h1>add_intervention</h1>
  <form action="./api/add_intervention.php" method="get">
    <ul>
      <li>
        <label for="id">date &nbsp;:</label>
        <input type="text" id="id" name="date" />
      </li>
      <li>
        <label for="id">nuig &nbsp;:</label>
        <input type="text" id="id" name="nuig" />
      </li>
      <li>
        <label for="id">intervention &nbsp;:</label>
        <input type="text" id="id" name="intervention" />
      </li>
      <li>
        <label for="mdp">commentaire&nbsp;:</label>
        <input type="text" id="mdp" name="commentaire"/>
      </li>
      <li>
        <label for="id">lieu &nbsp;:</label>
        <input type="text" id="id" name="lieu" />
      </li>
      <li>
        <label for="id">total &nbsp;:</label>
        <input type="text" id="id" name="total" />
      </li>
      <li>
        <label for="id">paye &nbsp;:</label>
        <input type="text" id="id" name="paye" />
      </li>
    </ul>
    <div class="button">
      <button type="submit">send</button>
    </div>
  </form>
</body>
</html>
