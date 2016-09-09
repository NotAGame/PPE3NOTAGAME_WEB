<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../MODELE/CommentaireModele.class.php');

$json = array(); //tableau pour stocker les commentaires
$monModele = new CommentaireModele ();

if (isset($_GET['idU']) & isset($_GET['idJV'])){
	//requete presente dans le modele qui supprime les commentaires avec la cle fournie
	try{
		$monModele->delete($_GET['idU'],$_GET['idJV']);
		$json['success'] = ("SUCCESS : Suppression REUSSIE ! : <br/>");
	} catch ( PDOException $pdoe ) {
		$json['error'] = ("ERREUR : Suppression ECHOUEE ! : <br/>" . $pdoe->getMessage ());
	}
}
echo json_encode($json);
?>