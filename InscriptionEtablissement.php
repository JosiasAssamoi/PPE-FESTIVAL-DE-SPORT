<?php
session_start();
include "_debut.inc.php";

include("_gestionBase.inc.php");
include("_controlesEtGestionErreurs.inc.php");
ini_set("SMTP", "smtp.free.fr");
ini_set("smpt_port", "25");

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

if ( isset($_POST['action']) )
{	// on recupere la ligne qui correspond a la response du formulaire si elle existe
	$sql=$connexion->prepare("Select nom,adresseElectronique,id from Etablissement where nom=? and adresseElectronique=?");
	$sql->execute(array($_POST['nom'],$_POST['email']));
	$etab=$sql->fetch();


	// si oui on lui envoit un nouveau mdp
	if ( isset($etab['nom']) && isset($etab['adresseElectronique']))
	{
		$newMdp=createPassword(10);
		$header="MIME-Version: 1.0\r\n";
		$header.='From:"Maison Des ligues"<support@maisondesligue.com>'."\n";
		$header.='Content-Type:text/html; charset="uft-8"'."\n";
		$header.='Content-Transfer-Encoding: 8bit';

		$message='
		<html>
			<body>

					Bonjour <i> <b>'.$etab['nom'].'</i> </b>, <br> <br>
					<br>Nous vous rappelons votre id : <b>'.$etab['id'].'</b><br>
          Voici votre nouveau mot de passe : <b>'.$newMdp.'</b>
					<br><br>N\'hesitez pas à nous contacter en cas de besoin
					<br />
					<img src="http://sportifsdelorraine.com/img/logo.png"/>
				</div>
			</body>
		</html>
		';

		$mail=mail($_POST['email'], "Reinitialisation de votre Mot de passe", $message, $header);
		if($mail)
		{
		// si le mail est parti on modifie le mdp dans la base de donnees de l'etablissement en question
			$sql=$connexion->prepare("Update Etablissement SET motDePasse =? where nom=?");
			$sql->execute(array($newMdp,$_POST['nom']));
			$_SESSION['emailverif']=$mail;
			$_SESSION['email']=$etab['adresseElectronique'];
		}
	}

}


echo " <br>
<table width='80%' cellspacing='0' cellpadding='0' align='center'>
   <tr>
      <td class='texteAccueil'>
        <form method = 'post' action = 'InscriptionEtablissement.php' ><center>
			<table width='85%' cellspacing='0' cellpadding='0' align='center'
   class='tabNonQuadrille'>
    <input type='hidden' value='validerDemandeMdp' name='action'>
      <tr class='enTeteTabNonQuad'>";
				if (ISSET($_SESSION['emailverif'])){
				if($_SESSION['emailverif']==1){ echo "<b> Felicitations vous avez reinitialisé votre mdp un mail a eté envoyé à l'adresse suivante : ".$_SESSION['email']." </b><br>";
				}session_unset(); session_destroy();}
				echo "
				<br>Entrer le nom de votre etablissement &nbsp &nbsp<input  required type = 'texte' name = 'nom' placeholder='Votre identifiant ...'> </input>	</br>
				<br>Entrer votre email &nbsp &nbsp <input  required type = 'email' name = 'email' placeholder='Votre email ...'> </input>	</br>
				<br><input type= 'submit' value= 'Demander un Mot de Passe' > </input><br><i><br>Un nouveau mot de passe vous sera envoyé automatiquement</i>
				<br> Pour vous connecter ...
				Cliquez <b>&rArr;</b> <a href='ConnexionEtablissement.php'>ici </a> </center>

			</table></form>
		</div>
      </td>

   </tr>
</table>";

?>
