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
$Checkip =VerifIp($connexion); 
if(!$Checkip){
	echo  'dedans';
    header('Location: ConnexionEtablissement.php');
    exit(); 
}


// CONSULTER LES ATTRIBUTIONS POUR L' ÉTABLISSEMENT


   echo "
   <table width='75%' cellspacing='0' cellpadding='0' align='center'
   <tr><td>";

   // POUR CHAQUE ÉTABLISSEMENT : AFFICHAGE D'UN TABLEAU COMPORTANT 2 LIGNES
   // D'EN-TÊTE ET LE DÉTAIL DES ATTRIBUTIONS
   $id=$_SESSION['idEtab'];
   $lgEtab=HebergementValidés($connexion,$id);
   
      $idEtab=$lgEtab['id'];
      $nomEtab=$lgEtab['nom'];
	  if($lgEtab['conventionSignee'] ==0)
	  {
		  $conventionSignee="Non signée";
	  }
	  else
	  {
		  $conventionSignee="Signee" ;
	  };

	  $infospratique=$lgEtab['informationsPratiques'];
    echo "<hr class='my-4'>";

      echo "
      <table width='75%' cellspacing='0' cellpadding='0' align='center'
      class='tabQuadrille'>";

      $nbOffre=$lgEtab["nombreChambresOffertes"];
      $nbOccup=obtenirNbOccup($connexion, $id);
      // Calcul du nombre de chambres libres dans l'établissement
      $nbChLib = $nbOffre - $nbOccup;

      // AFFICHAGE DE LA 1ÈRE LIGNE D'EN-TÊTE
      echo "
      <tr class='enTeteTabQuad'>
         <td colspan='2' align='left'><strong>$nomEtab</strong>&nbsp;
         (Offre : $nbOffre&nbsp;&nbsp;Disponibilités : $nbChLib)
         </td>
      </tr>";

      // AFFICHAGE DE LA 2ÈME LIGNE D'EN-TÊTE
      echo "
      <tr class='ligneTabQuad'>
         <td width='65%' align='left'><i><strong>Nom de L'equipe</strong></i></td>
         <td width='35%' align='left'><i><strong>Chambres attribuées</strong></i>
         </td>
      </tr>";

      // AFFICHAGE DU DÉTAIL DES ATTRIBUTIONS : UNE LIGNE PAR GROUPE AFFECTÉ
      // DANS L'ÉTABLISSEMENT
      $req=obtenirReqGroupesEtab($id);
      $rsGroupe=$connexion->query($req);
	  $rsGroupe->execute();
      $lgGroupe=$rsGroupe->fetchall();
	  if(empty($lgGroupe)){
		  echo "<table width='75%' cellspacing='0' cellpadding='0' align='center'>
   <tr>  
      <td class='texteAccueil'>
         <br> <i>  Vous n'avez aucune equipes attribuées : <br>Votre convention n'a probablement pas été signée. <BR> Si celle ci a été signée des équipes vous seront très prochainement attribuées
     :) <br></i>  </td>
   </tr>";
	  }
	  else{
		 
      // BOUCLE SUR LES GROUPES (CHAQUE GROUPE EST AFFICHÉ EN LIGNE)
     foreach($lgGroupe as $lgGroupe)
      {
         $idGroupe=$lgGroupe['id'];
         $nomGroupe=$lgGroupe['nom'];
		 $paysGroupe=$lgGroupe['nomPays'];

         echo "
         <tr class='ligneTabQuad'>
            <td width='65%' align='left'>$nomGroupe <b>($paysGroupe)</b><br> 
			</td> ";
         // On recherche si des chambres ont déjà été attribuées à ce groupe
         // dans l'établissement
         $nbOccupGroupe=obtenirNbOccupGroupe($connexion, $idEtab, $idGroupe);
         echo "
            <td width='35%' align='left'>$nbOccupGroupe</td>
         </tr> ";
       //  $lgGroupe=mysql_fetch_array($rsGroupe);
      } // Fin de la boucle sur les groupes
	  }
      echo "
       <tr class='ligneTabQuad'>  <td width='65%' align='left'> <br>Etat convention</u> : $conventionSignee<br> </tr></td></table> ";
  

?>
