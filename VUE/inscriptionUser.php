<?php
session_start ();

require_once ('../Class/PageBase.class.php');
require_once ('../Class/PageSecurisee.class.php');
require_once('../MODELE/CommunautesModele.class.php');


?>	
	
<?php





if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
	$pageInscriptionUser = new pageSecurisee ( "Inscription d'un utilisateur..." );
} else {
	$pageInscriptionUser = new pageBase ( "Inscription d'un utilisateur..." );
}

$pageInscriptionUser->script.='jquery';
$pageInscriptionUser->script.='jquery.validate';
$pageInscriptionUser->script.='validate';


$pageInscriptionUser->contenu = '<section>
		<article>
			<form id="formInscriptionUser" method="post" action="../CONTROLEUR/tt_InscriptionUser.php">
			<fieldset>
				<legend>Utilisateur</legend>
				<div>
					<span>Email : </span>
					<input type="text" name="email" id="email"/>
				</div>		
				<div>
					<span>pseudo : </span>
					<input  type="text" name="pseudo"  id="pseudo"/>
				</div>
				<div>
				<label for="communaute">Communauté :</label>
				<select type="text" name="communaute" id="communaute">';
				$communautesModele = new CommunautesModele();
				$comms = $communautesModele->getCommunautes();
				foreach ($comms as $c)
					$pageInscriptionUser->contenu .= '<option value="' . $c->id . '">' . $c->libelle . '</option>';
				$pageInscriptionUser->contenu .= '</select>
				</div>
			</fieldset>
				<p><input class="submit" type="submit" id="submit" value="Valider" /></p>
			</form>
		</article>		
	</section>';
				
				
// TRAITEMENT du RETOUR DE L'ERREUR par le controleur
if (isset($_GET['error']) && !empty($_GET['error'])) {  
	?>	<script type="text/javascript">	montrer();</script>	<?php
	$pageInscriptionUser->contenu .= '<div id="infoERREUR"><h1>Informations !</h1><div id="dialog1" >'. $_GET['error'].'</div>';
	$verif = preg_match("/ERREUR/",$_GET['error']);
		if ( $verif == TRUE ){
		$pageInscriptionUser->contenu .= '<a class="no" onclick="cacher();">OK</a></div>';
		}else {
		$pageInscriptionUser->contenu .= '<a class="yes" onclick="cacher();">OK</a></div>';
		}
}

$pageInscriptionUser->afficher ();

?>
