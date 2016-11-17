<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../MODELE/CommentaireModele.class.php');

$modeleComs = new commentaireModele ();
$listeComs = $modeleComs->getCommentairesInvalides();

foreach ($listeComs as $unC){
	if (isset ( $_POST [$unC->idu.'-'.$unC->idjv] )) {
		$idu = $unC->idu;
		$idjv = $unC->idjv;
		if ($_POST[$unC->idu.'-'.$unC->idjv] = "valid") {
			$modeleComs->setValid($idu, $idjv);
		}
		else {
			$modeleComs->remCommentaire($idu, $idjv);
		}
	}
}

$listeComs->closeCursor (); // pour liberer la memoire occupee par le resultat de la requete
$listeComs = null; // pour une autre execution avec cette variable

header ('Location: ../VUE/gererCommentaires.php');
exit ();
?>