<?php

session_start();
include "_debut.inc.php";

include("_gestionBase.inc.php");
include("_controlesEtGestionErreurs.inc.php");


// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival

$connexion=connect();
if (!$connexion)
{
   ajouterErreur("Echec de la connexion au serveur MySql");
   afficherErreurs();
   exit();
}
if (!selectBase($connexion))
{
   ajouterErreur("La base de données festival est inexistante ou non accessible");
   afficherErreurs();
   exit();
}
$utf8=$connexion->query('SET NAMES UTF8');


if(isset($_POST['id']) AND isset($_POST['mdp']))
{
	$connexion = new connexionEtab ($_POST['id'],$_POST['mdp']);
	$check = $connexion->check();
	if($check=='nickel')
	{
		if($connexion->session())
		{
			header('location:EspaceEtablissement.php');
		}
		else
		{
			echo 'il y a eu un pb de connexion' ;
		}
	}
	else
	{
		$erreur = $check;
	}
}


echo " <br>
<table width='80%' cellspacing='0' cellpadding='0' align='center'>
   <tr>
      <td class='texteAccueil'>
        <form method = 'post' action 'connexion.php' ><center>
				<br>&nbsp &nbsp &nbsp Entrer votre identifiant &nbsp &nbsp <input  required type = 'text' name = 'id' placeholder='Votre id ...'> </input>	</br>
				<br>Entrer un mot de passe &nbsp &nbsp <input  required type = 'password' name = 'mdp' placeholder='Mot de passe ...'> </input>	</br>
				<br><input type= 'submit' value= 'Connexion' > </input><br>";
				 if(isset($_SESSION['idEtab'])){ echo '<b>'.$_SESSION['nom'] .'</b>
				vous êtes deja connecté vous allez être automatiquement redirigé à l\'acceuil' ; header('Refresh:0;EspaceEtablissement.php'); }
				if (isset($erreur)){ echo '!!! = '. $erreur ; }
				echo "<br> Vous êtes un nouvel etablissement et vous n'avez pas encore de mot de passe ?
				Cliquez <b>&rArr;</b> <a href='InscriptionEtablissement.php'>ici </a> </center>

			</form>
		</div>
      </td>

   </tr>
</table>";

?>
