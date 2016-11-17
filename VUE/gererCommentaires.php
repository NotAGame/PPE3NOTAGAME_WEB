<?php
session_start();

require_once ('../Class/PageBase.class.php');
require_once ('../Class/PageSecurisee.class.php');
require_once ('../MODELE/CommentaireModele.class.php');

$modeleComs = new commentaireModele ();
$listeComs = $modeleComs->getCommentairesInvalides();

if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
	$pageGererCommentaire = new pageSecurisee( "Gérer les commentaires sur les jeux..." );
} else {
	$pageGererCommentaire = new pageBase ( "Gérer les commentaires sur les jeux..." );
}

$pageGererCommentaire->contenu = '
	<form id="formulaire" method="POST" action="../CONTROLEUR/tt_GererCommentaire.php">

								<table border=1>
								<tr>
								<th>Utilisateur </th>
								<th>Jeux Video </th>
								<th>Commentaire </th>
								<th>Validation</th>
								</tr>
								';
								
foreach ($listeComs as $unC){
	$pageGererCommentaire->contenu .= '<tr>
								<td>'.$unC->pseudo.'</td>
								<td>'.$unC->nomjv.'</td>
								<td>'.$unC->libelle.'</td>
								<td>Valider<input type="radio" name="'.$unC->idu.'-'.$unC->idjv.'" id="'.$unC->idu.'-'.$unC->idjv.'" value="valid">Refuser<input type="radio" name="'.$unC->idu.'-'.$unC->idjv.'" id="'.$unC->idu.'-'.$unC->idjv.'" value="refuse"></td>
								</tr>';
}

$pageGererCommentaire->contenu .= '<input type="submit" name="envoyer" id="envoyer" value="Gerer"/>
</form>';
	
$pageGererCommentaire->afficher ();

?>
