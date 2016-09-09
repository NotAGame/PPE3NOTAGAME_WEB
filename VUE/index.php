<?php
session_start ();

require_once ('../Class/PageBase.class.php');
require_once ('../Class/PageSecurisee.class.php');

if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
	$pageIndex = new pageSecurisee ( "Bienvenue sur NotaGAME..." );
} else {
	$pageIndex = new pageBase ( "Bienvenue sur NotaGAME..." );
}

$pageIndex->contenu = '<section>
		<article>
			<img src="./Image/Jeux-videos.jpeg" alt="photos des pochettes de jeux videos"> 
		</article>	
	</section>';
				

$pageIndex->afficher ();

?>


