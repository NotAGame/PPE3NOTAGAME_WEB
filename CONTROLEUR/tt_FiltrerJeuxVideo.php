<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../MODELE/JeuxVideosModele.class.php');

$json = array(); //tableau pour stocker les jeux
$monModele = new jeuxVideosModele();

if (isset($_GET['genres'])){
	// Un ou plusieurs genres ont été spécifiés, on retourne les jeux correspondants.
	$liste = $monModele->getJeuxVideoParGenres(explode(',', $_GET['genres']));
}
else{
	// Aucun genre spécifié, on retourne tous les jeux.
	$res = $monModele->getJeuxVideoS();
	$liste = $res->fetchAll();
	$res->closeCursor(); // pour liberer la memoire occupee par le resultat de la requete
}

// Parcours de tous les résultats contenus dans $liste
foreach ($liste as $unJeu ) {
	array_push($json, $unJeu);
}

// envoi du resultat formate en json
echo json_encode($json);