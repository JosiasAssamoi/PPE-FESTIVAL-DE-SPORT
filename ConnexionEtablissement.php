
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


$Checkip =VerifIp($connexion); 
var_dump($Checkip);
if(!$Checkip){
	$delai=0; 
    $url='http://localhost/ConnexionEtablissement';
    header("Refresh: $delai;url=$url");
}
	
echo " <br> 
<table width='80%' cellspacing='0' cellpadding='0' align='center'>
   <tr>  
      <td class='texteAccueil'>
         Cette application web permet de gérer l'hébergement des groupes de musique 
         durant le festival Folklores du Monde.
      </td>

   </tr>
</table>";

?>


