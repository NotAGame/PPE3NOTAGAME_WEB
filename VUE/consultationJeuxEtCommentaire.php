<?php
session_start();

require_once ('../Class/PageBase.class.php');
require_once ('../Class/PageSecurisee.class.php');
require_once ('../MODELE/JeuxVideosModele.class.php');


if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
	$pageConsultationJetC = new pageSecurisee( "Consulter les commentaires sur les jeux..." );
} else {
	$pageConsultationJetC = new pageBase ( "Consulter les commentaires sur les jeux..." );
}
$pageConsultationJetC->style = 'template'; //pour gérer le style de mon tableau
$pageConsultationJetC->script ='jquery-3.0.0.min';
$pageConsultationJetC->script = 'ajaxRecupCommentairesParJeux'; //pour gérer par l'AJAX le clic de la case à cocher et afficher les commentaires correspondants


$JVMod = new JeuxVideosModele();
$listeJV = $JVMod->getJeuxVideoS(); //requête via le modele

$pageConsultationJetC->contenu = '<section>
					<table>
					<tr><th>Nom du jeu</th><th>ann&eacute;e de sortie</th><th>&eacute;diteur</th></tr>';
//parcours du résultat de la requete
foreach ($listeJV as $unJV){
					$pageConsultationJetC->contenu .= '<tr><td>'.$unJV->NOMJV.'</td><td>'.$unJV->ANNEESORTIE.'</td><td>'.$unJV->EDITEUR.'</td>
					<td><input type="radio" onclick="jsClickRadioButton();" name="nomidjv"  id="'. $unJV->IDJV.'"  value="'. $unJV->IDJV.'" /></td></tr>';
}
$listeJV->closeCursor (); // pour libérer la mémoire occupée par le résultat de la requête
$listeJV = null; // pour une autre exécution avec cette variable

$pageConsultationJetC->contenu .= '</table>';

//div qui sert à afficher les commentaires propore à un jeu : rempli à partir du json retourné par la requête AJAX
$pageConsultationJetC->contenu .= '<div id="listeCom"></div></section>';


$pageConsultationJetC->afficher ();


?>


