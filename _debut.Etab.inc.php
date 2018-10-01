 <!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ppe_festival_sport">
    <meta name="author" content="alexandre">
    <title>Sport</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="EspaceEtablissement.php">Festival Sportif du Monde<span class="sr-only">(current)</span></a>
          </li>
		   <li class="nav-item active">
            <a class="nav-link" href="EspaceEtablissement.Hebergement.php">Vos hebergements<span class="sr-only">(current)</span></a>
          </li>
		  <li class="nav-item active">
            <a class="nav-link" href="listeGroupes.Etab.php">Details Equipes<span class="sr-only">(current)</span></a>
          </li>
            </div>
          </li>
        </ul>
      </div>
    </nav>

  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
// si on est connecté on met le lien de deconnexion et on affiche un msg de bienvenue
if(isset($_SESSION['nom'])) echo '</br><h4 align = "center" ><p> Bienvenue : '.$_SESSION['nom'].'  - <a href="deconnexion.php">Deconnexion</a></p></h4> ';

?>
