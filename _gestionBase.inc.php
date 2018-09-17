<?php

// FONCTIONS DE CONNEXION

function connect()
{
	try
	{ 
	$bd = 'festival';
	$hote = 'localhost';
	$login = 'root';
	$mdp = '';
	$port='3306';
	$dns = 'mysql:host='.$hote .';dbname='.$bd.';port='.$port;
	$connexion = new PDO( $dns, $login, $mdp );
	$connexion -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){die('Erreur : '.$e->getMessage());}
   return $connexion;
}
	//$connexion=connect();
	//var_dump($connexion) ;

function selectBase($connexion)
{
  $connexion->query('SET NAMES UTF8'); 
   return $connexion;
}


// FONCTIONS DE GESTION DES ÉTABLISSEMENTS

function obtenirReqEtablissements()
{
   $req="select  id, nom from Etablissement order by id";
   return $req;
}

function obtenirReqEtablissementsOffrantChambres()
{
   $req="select id, nom, nombreChambresOffertes from Etablissement where 
         nombreChambresOffertes!=0 order by id";
   return $req;
}

function obtenirReqEtablissementsAyantChambresAttribuées()
{
   $req="select distinct id, nom, nombreChambresOffertes from Etablissement, 
         Attribution where id = idEtab order by id";
   return $req;
}

function obtenirDetailEtablissement($connexion, $id)
{
   $req="select * from Etablissement where id='$id'";
   $rsEtab=$connexion->query($req);
   $rsEtab->execute();
   $rsEtab=$rsEtab->fetch();
   return $rsEtab;
}

function supprimerEtablissement($connexion, $id)
{
   $req="delete from Etablissement where id='$id'";
 $sup= $connexion->query($req);
 // $sup->execute();
}
 
function modifierEtablissement($connexion, $id, $nom, $adresseRue, $codePostal, 
                               $ville, $tel, $adresseElectronique, $type, 
                               $civiliteResponsable, $nomResponsable, 
                               $prenomResponsable, $nombreChambresOffertes)
{  
   $nom=str_replace("'", "''", $nom);
   $adresseRue=str_replace("'","''", $adresseRue);
   $ville=str_replace("'","''", $ville);
   $adresseElectronique=str_replace("'","''", $adresseElectronique);
   $nomResponsable=str_replace("'","''", $nomResponsable);
   $prenomResponsable=str_replace("'","''", $prenomResponsable);
  
   $req="update Etablissement set nom='$nom',adresseRue='$adresseRue',
         codePostal='$codePostal',ville='$ville',tel='$tel',
         adresseElectronique='$adresseElectronique',type='$type',
         civiliteResponsable='$civiliteResponsable',nomResponsable=
         '$nomResponsable',prenomResponsable='$prenomResponsable',
         nombreChambresOffertes='$nombreChambresOffertes' where id='$id'";
   
   $modif=$connexion->query($req);
   $modif->execute();
   
   
}

function creerEtablissement($connexion, $id, $nom, $adresseRue, $codePostal, 
                            $ville, $tel, $adresseElectronique, $type, 
                            $civiliteResponsable, $nomResponsable, 
                            $prenomResponsable, $nombreChambresOffertes)
{ 
   $nom=str_replace("'", "''", $nom);
   $adresseRue=str_replace("'","''", $adresseRue);
   $ville=str_replace("'","''", $ville);
   $adresseElectronique=str_replace("'","''", $adresseElectronique);
   $nomResponsable=str_replace("'","''", $nomResponsable);
   $prenomResponsable=str_replace("'","''", $prenomResponsable);
   
   $req="insert into Etablissement values ('$id', '$nom', '$adresseRue', 
         '$codePostal', '$ville', '$tel', '$adresseElectronique', '$type', 
         '$civiliteResponsable', '$nomResponsable', '$prenomResponsable',
         '$nombreChambresOffertes')";
   
    $creation=$connexion->query($req);
	//$creation->execute();
}


function estUnIdEtablissement($connexion, $id)
{
   $req="select * from Etablissement where id='$id'";
   $rsEtab=$connexion->query($req);
   $rsEtab->execute();
   $rsEtab= $rsEtab->fetch();
   return $rsEtab;
}

function estUnNomEtablissement($connexion, $mode, $id, $nom)
{
   $nom=str_replace("'", "''", $nom);
   // S'il s'agit d'une création, on vérifie juste la non existence du nom sinon
   // on vérifie la non existence d'un autre établissement (id!='$id') portant 
   // le même nom
   if ($mode=='C')
   {
      $req="select * from Etablissement where nom='$nom'";
   }
   else
   {
      $req="select * from Etablissement where nom='$nom' and id!='$id'";
   }
   $rsEtab=$connexion->query($req);
   $rsEtab->execute();
   $rsEtab= $rsEtab->fetch();
   return $rsEtab;
}

function obtenirNbEtab($connexion)
{
   $req="select count(*) as nombreEtab from Etablissement";
   $rsEtab=$connexion->query($req);
   $rsEtab= $rsEtab->execute();
   $lgEtab=$rsEtab->fetch();
   return $lgEtab["nombreEtab"];
}

function obtenirNbEtabOffrantChambres($connexion)
{
   $req="select count(*) as nombreEtabOffrantChambres from Etablissement where 
         nombreChambresOffertes!=0";
   $rsEtabOffrantChambres=$connexion->query($req);
    $rsEtabOffrantChambres->execute();
   $lgEtabOffrantChambres= $rsEtabOffrantChambres->fetch();
   return $lgEtabOffrantChambres["nombreEtabOffrantChambres"];
}

// Retourne false si le nombre de chambres transmis est inférieur au nombre de 
// chambres occupées pour l'établissement transmis 
// Retourne true dans le cas contraire
function estModifOffreCorrecte($connexion, $idEtab, $nombreChambres)
{
   $nbOccup=obtenirNbOccup($connexion, $idEtab);
   return ($nombreChambres>=$nbOccup);
}

// FONCTIONS RELATIVES AUX GROUPES

function obtenirReqIdNomGroupesAHeberger()
{
   $req="select id, nom from Groupe where hebergement='O' order by id";
   return $req;
}

function obtenirNomGroupe($connexion, $id)
{
   $req="select nom from Groupe where id='$id'";
   $rsGroupe=$connexion->query($req);
   $rsGroupe->execute();
   
   
   $lgGroupe=$rsGroupe->fetch();
   return $lgGroupe["nom"];
}

// FONCTIONS RELATIVES AUX ATTRIBUTIONS

// Teste la présence d'attributions pour l'établissement transmis    
function existeAttributionsEtab($connexion, $id)
{
   $req="select * From Attribution where idEtab='$id'";
   $rsAttrib=$connexion->query($req);
   $rsAttrib->execute();
   $rsAttrib= $rsAttrib->fetch();
   return $rsAttrib;
}

// Retourne le nombre de chambres occupées pour l'id étab transmis
function obtenirNbOccup($connexion, $idEtab)
{
   $req="select IFNULL(sum(nombreChambres), 0) as totalChambresOccup from
        Attribution where idEtab='$idEtab'";
   $rsOccup=$connexion->query($req);
   $rsOccup->execute();
   $lgOccup= $rsOccup->fetch();
   return $lgOccup["totalChambresOccup"];
}

// Met à jour (suppression, modification ou ajout) l'attribution correspondant à
// l'id étab et à l'id groupe transmis
function modifierAttribChamb($connexion, $idEtab, $idGroupe, $nbChambres)
{
   $req="select count(*) as nombreAttribGroupe from Attribution where idEtab=
        '$idEtab' and idGroupe='$idGroupe'";
   $rsAttrib=$connexion->query($req);
   $rsAttrib->execute();
   $rsAttrib=$rsAttrib->fetch();
   $lgAttrib=$rsAttrib;
   if ($nbChambres==0)
      $req="delete from Attribution where idEtab='$idEtab' and idGroupe='$idGroupe'";
   else
   {
      if ($lgAttrib["nombreAttribGroupe"]!=0)
         $req="update Attribution set nombreChambres=$nbChambres where idEtab=
              '$idEtab' and idGroupe='$idGroupe'";
      else
         $req="insert into Attribution values('$idEtab','$idGroupe', $nbChambres)";
   }
   $connexion->query($req);
 //  $connexion->execute($req);
}

// Retourne la requête permettant d'obtenir les id et noms des groupes affectés
// dans l'établissement transmis
function obtenirReqGroupesEtab($id)
{
   $req="select distinct id, nom from Groupe, Attribution where 
        Attribution.idGroupe=Groupe.id and idEtab='$id'";
   return $req;
}
            
// Retourne le nombre de chambres occupées par le groupe transmis pour l'id étab
// et l'id groupe transmis
function obtenirNbOccupGroupe($connexion, $idEtab, $idGroupe)
{
   $req="select nombreChambres From Attribution where idEtab='$idEtab'
        and idGroupe='$idGroupe'";
   $rsAttribGroupe=$connexion->query($req);
   $rsAttribGroupe->execute();
   $rsAttribGroupe=$rsAttribGroupe->fetch();
   if ($lgAttribGroupe=$rsAttribGroupe)
      return $lgAttribGroupe["nombreChambres"];
   else
      return 0;
}

?>

