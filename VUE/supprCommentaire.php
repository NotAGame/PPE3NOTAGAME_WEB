<?php
session_start();

require_once ('../Class/PageBase.class.php');
require_once ('../Class/PageSecurisee.class.php');
require_once ('../MODELE/CommentaireModele.class.php');


if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
	$pageSupprCommentaire = new pageSecurisee( "supprimer les commentaires sur les jeux..." );
} else {
	$pageSupprCommentaire = new pageBase ( "supprimer les commentaires sur les jeux..." );
}


$pageSupprCommentaire->style = 'template'; //pour gérer le style de mon tableau	
$pageSupprCommentaire->script ='jquery-3.0.0.min'; //pour gérer les requetes AJAX
$pageSupprCommentaire->script = 'ajaxListeCommentaire'; //pour afficher les commentaires dans le tableau
$pageSupprCommentaire->script = 'ajaxSupprCommentaire'; //pour gérer par l'AJAX le clic de la case à cocher et afficher les commentaires correspondants


$pageSupprCommentaire->contenu = '<section>
					<table id="tabCommentaires"></table>
								</section>';

// TRAITEMENT du RETOUR DE L'ERREUR ICI par la requête AJAX
//ici c'est le javascript qui va changer la couleur du boutton OK
	$pageSupprCommentaire->contenu .= '<div id="infoERREUR"><h1>Informations !</h1><div id="dialog1" ></div>
		<a id="baliseA" class="no" onclick="cacher();">OK</a></div>';
	
$pageSupprCommentaire->afficher ();

?>
