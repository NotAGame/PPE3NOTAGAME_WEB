<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../MODELE/JeuxVideosModele.class.php');

$json = array(); //tableau pour stocker les jeux
$monModele = new jeuxVideosModele();

if (isset($_GET['genres']) && !empty($_GET['genres'])){
	// Un ou plusieurs genres ont été spécifiés, on retourne les jeux correspondants.
	$liste = $monModele->getJeuxVideoParGenres(explode(',', $_GET['genres']));
}
else if (isset($_GET['support']) && !empty($_GET['support'])){
	// Un support ont été spécifiés, on retourne les jeux correspondants.
	$liste = $monModele->getJeuxVideoParSupport(explode(',', $_GET['support']));
}
else if (isset($_GET['editeur']) && !empty($_GET['editeur'])){
	// Un editeur ont été spécifiés, on retourne les jeux correspondants.
	$liste = $monModele->getJeuxVideoParEditeur(explode(',', $_GET['editeur']));
}

// methode avec plusieurs données

else if ((isset($_GET['genres']) && !empty($_GET['genres']))&&(isset($_GET['support']) && !empty($_GET['support']))){
	// Un ou plusieurs genres et un support ont été spécifiés, on retourne les jeux correspondants.
	$liste = $monModele->getJeuxVideoParGenresEtSupport(explode(',', $_GET['genres'] , ',', $_GET['support']));
}
else if (isset($_GET['genres']) && !empty($_GET['genres'])&&isset($_GET['editeur']) && !empty($_GET['editeur'])){
	// Un ou plusieurs genres et un editeur ont été spécifiés, on retourne les jeux correspondants.
	$liste = $monModele->getJeuxVideoParGenresEtEditeur(explode(',', $_GET['genres'] , ',', $_GET['editeur']));
}
else if ((isset($_GET['support']) && !empty($_GET['support']))&&(isset($_GET['editeur']) && !empty($_GET['editeur']))){
	// Un support et un editeur ont été spécifiés, on retourne les jeux correspondants.
	$liste = $monModele->getJeuxVideoParSupportEtEditeur(explode(',', $_GET['support'], ',', $_GET['editeur']));
}
else if ((isset($_GET['support']) && !empty($_GET['support']))&&(isset($_GET['editeur']) && !empty($_GET['editeur'])) && (isset($_GET['genres']) && !empty($_GET['genres']))){
	// si genre et support et editeur ont été spécifiés, on retourne les jeux correspondants.
	$liste = $monModele->getJeuxVideoParSupportEtEditeurEtGenre(explode(',', $_GET['support'], ',', $_GET['editeur'], ',', $_GET['genres']));
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