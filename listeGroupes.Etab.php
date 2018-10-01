<?php
session_start();
include("_debut.Etab.inc.php");
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
// VERIF IP
/*$Checkip =VerifIp($connexion);
if(!$Checkip){
	echo  'dedans';
    header('Location: ConnexionEtablissement.php');
    exit();
}*/



  echo "
   <table width='75%' cellspacing='0' cellpadding='0' align='center'
   <tr><td>";



      // AFFICHAGE DU DÉTAIL DES ATTRIBUTIONS : UNE LIGNE PAR GROUPE AFFECTÉ
      // DANS L'ÉTABLISSEMENT
	  $id=$_SESSION['idEtab'];
      $rsGroupe=obtenirDetailGroupe($connexion,$id);
	  if(empty($rsGroupe)){
		  echo "<table width='80%' cellspacing='0' cellpadding='0' align='center'>
   <tr>
      <td class='texteAccueil'>
         <center><br> <i> <b> Vous n'avez aucune equipes attribuées : <br>Votre convention n'a probablement pas été signée. <BR> Si celle ci a été signée des équipes vous seront très prochainement attribuées
     :) </i> </b> </td>
   </tr>";
	  }

	 foreach ( $rsGroupe as $lgGroupe)
	 {


         $idGroupe=$lgGroupe['id'];
         $nomGroupe=$lgGroupe['nom'];
		 $paysGroupe=$lgGroupe['nomPays'];
		 $identiteResponsable=$lgGroupe['identiteResponsable'];
		 $adressePostale=$lgGroupe['adressePostale'];
		 $nombrePersonnes=$lgGroupe['nombrePersonnes'];

         echo "
		 <table width='75%' cellspacing='0' cellpadding='0' align='center'
      class='tabQuadrille'>
         <tr class='ligneTabQuad'>
            <td width='65%' align='left'>$nomGroupe <b>($paysGroupe)</b><br>
			</td> ";
         // On recherche si des chambres ont déjà été attribuées à ce groupe
         // dans l'établissement
         $nbOccupGroupe=obtenirNbOccupGroupe($connexion, $id, $idGroupe);
         echo "
            <td width='35%' align='left'>Nombre de chambre deja attribuées : $nbOccupGroupe</td>
         </tr>
		 <br> <td>"; if(!empty($identiteResponsable)){echo " Identité du responsable : $identiteResponsable <br> </td>"; }
		  if(!empty($adressePostale)){echo "<tr><td> Adresse postale : $adressePostale</td></tr> "; }
		  if(!empty($nombrePersonnes)){echo "<tr><td> Nombre de personnes : $nombrePersonnes </td></tr>"; }
       //  $lgGroupe=mysql_fetch_array($rsGroupe);


      echo "
      </table><hr> ";
	 }
?>
