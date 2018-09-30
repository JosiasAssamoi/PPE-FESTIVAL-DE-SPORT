
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
$Checkip =VerifIp($connexion); 
if(!$Checkip){
    header('Location: ConnexionEtablissement.php');
    exit(); 
}




	
echo " <br> 
<table width='80%' cellspacing='0' cellpadding='0' align='center'>
   <tr>  
      <td class='texteAccueil'>
         Cette application web permet de gérer l'hébergement des groupes de musique 
         durant le festival Folklores du Monde.
      </td>
   </tr>
   <tr>
      <td>&nbsp;
      </td>
   </tr>
   <tr>
      <td class='texteAccueil'>
          Elle offre les services suivants :
      </td>
   </tr>
   <tr>
      <td>&nbsp;
      </td>
   </tr>
   <tr>
      <td class='texteAccueil'>
      <ul>
         <li>Gérer les établissements (caractéristiques et capacités d'accueil) acceptant d'héberger les groupes de musiciens.
         <p>
	      </p>
         <li>Consulter, réaliser ou modifier les attributions des chambres aux groupes dans les établissements.
      </ul>
      </td>
   </tr>
</table>";

?>


