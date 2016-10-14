<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../MODELE/JeuxVideosModele.class.php');

$json = array(); //tableau pour stocker les jeux
$monModele = new jeuxVideosModele();

if (isset($_GET['genres'])){
	//requete presente dans le modele qui retourne les .
	$liste = $monModele->getJeuxVideosParGenre($_GET['genres']); 
}
else{
	//requete presente dans le modele qui renvoie TOUS LES COMMENTAIRES
	$liste = $monModele->getJeuxVideoS();
}

//parcours de tous les resultats contenus dans $liste
foreach ($liste as $unJeu ) {
// je remplis un tableau JSON avec juste le libelle du commentaire
		array_push($json, $unJeu);
		
		}
			
$liste->closeCursor (); // pour liberer la memoire occupee par le resultat de la requete
$liste = null; // pour une autre execution avec cette variable

// envoi du resultat formate en json
echo json_encode($json);