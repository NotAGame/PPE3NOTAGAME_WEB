<?php
session_start();

require_once ('../Class/PageBase.class.php');
require_once ('../Class/PageSecurisee.class.php');
require_once('../MODELE/EditeurModele.class.php');
require_once('../MODELE/GenresModele.class.php');
require_once ('../MODELE/JeuxVideosModele.class.php');
require_once('../MODELE/SupportModele.class.php');


if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
	$pageConsultationJetC = new pageSecurisee( "Consulter les commentaires sur les jeux..." );
} else {
	$pageConsultationJetC = new pageBase ( "Consulter les commentaires sur les jeux..." );
}
$pageConsultationJetC->style = 'template'; //pour gérer le style de mon tableau
$pageConsultationJetC->script ='jquery-3.0.0.min';
$pageConsultationJetC->script = 'ajaxRecupCommentairesParJeux'; //pour gérer par l'AJAX le clic de la case à cocher et afficher les commentaires correspondants
$pageConsultationJetC->script = 'ajaxFiltrerJeux';


$genresMod = new GenresModele();
$listeGenres = $genresMod->getGenres();

$JVMod = new JeuxVideosModele();
$listeJV = $JVMod->getJeuxVideoS(); //requête via le modele

$pageConsultationJetC->contenu = '<h2>Filtrer :</h2><form id="formFiltrer" action="#" method="get">';
foreach ($listeGenres as $genre) {
	$pageConsultationJetC->contenu .= '<input type="checkbox" id="genre' . $genre->id . '" name="genre' . $genre->id . '" /><label for="genre' . $genre->id . '">' . $genre->libelle . '</label>';
}
$pageConsultationJetC->contenu .= '<label for="support">Support :</label>
	<select name="support" id="support">
		<option value="0">--</option>';
		$supports = new SupportModele();
		foreach ($supports->getSupports() as $s)
			$pageConsultationJetC->contenu .= '<option value="' . $s->IDS . '">' . $s->NOMS . '</option>';
$pageConsultationJetC->contenu .= '</select>
<label for="editeur">Editeur :</label>
<select id="editeur" name="editeur">
	<option value="0">--</option>';
	$editeurs = new EditeurModele();
	foreach ($editeurs->getEditeurs() as $e)
		$pageConsultationJetC->contenu .= '<option value="' . $e->editeur . '">' . $e->editeur . '</option>';
$pageConsultationJetC->contenu .= '</select><input type="submit" value="Filtrer" /></form>
					<section>
					<table id="tabJeux">
					<tr><th>Nom du jeu</th><th>Ann&eacute;e de sortie</th><th>Éditeur</th></tr>';

$pageConsultationJetC->contenu .= '</table>';

//div qui sert à afficher les commentaires propore à un jeu : rempli à partir du json retourné par la requête AJAX
$pageConsultationJetC->contenu .= '<div id="listeCom"></div></section>';


$pageConsultationJetC->afficher ();


?>


