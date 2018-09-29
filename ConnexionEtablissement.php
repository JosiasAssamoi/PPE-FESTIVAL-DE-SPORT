<?php

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

	
echo " <br> 
<table width='80%' cellspacing='0' cellpadding='0' align='center'>
   <tr>  
      <td class='texteAccueil'>
        <form method = 'post' action 'connexion.php' ><center>
				<br>&nbsp &nbsp &nbsp Entrer Votre identifiant  <input  required type = 'text' name = 'pseudo' placeholder='Votre id...'> </input>	</br>
				<br>Entrer un mot de passe &nbsp &nbsp <input  required type = 'password' name = 'mdp' placeholder='mot de passe ...'> </input>	</br>
				<br><input type= 'submit' value= 'Connexion' > </input><br>
				<br> Vous êtes un nouvel etablissement et vous n'avez pas encore de mot de passe ? 
				Cliquez <b>&rArr;</b> <a href='InscriptionEtablissement.php'>ici </a> </center>
			
			</form>
		</div>
      </td>

   </tr>
</table>";

?>


