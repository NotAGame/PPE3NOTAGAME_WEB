<?php
require_once ('../Class/Connexion.class.php');
class commentaireModele {
	/*
	 * propriete d'un commentaire conforme à la BDD
	 */
	
	// identifiant de connexion utile dans toute la classe
	private $IDC;
	public function __construct() {
		// creation de la connexion afin d'executer les requÃªtees
		try {
			$ConnexionContact = new Connexion ();
			$this->IDC = $ConnexionContact->IDconnexion;
		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}
	public function add($idu,$idjv, $libelleCom) {
		// ajoute ce contact dans la BDD
		$nb = 0;
		if ($this->IDC) {
			$req = "INSERT INTO commentaire(`idu`, `idjv`, `libelle`) VALUES  ('" . $idu . "','" . $idjv . "','" . $libelleCom . "');";
			$nb = $this->IDC->exec ( $req );
		}
		return $nb; // si nb =1 alors l'insertion s est bien passee
	}
	
	public function setValid($idu, $idjv) {
		$nb = 0;
		if ($this->IDC) {
			$req = "UPDATE commentaire SET valide = 1 WHERE IDU = ".$idu." AND IDJV = ".$idjv.";";
			$nb = $this->IDC->exec ( $req );
		}
		return $nb;
	}
	
	public function remCommentaire($idu, $idjv) {
		$nb = 0;
		if ($this->IDC) {
			$req = "DELETE FROM commentaire WHERE IDU = ".$idu." AND IDJV = ".$idjv.";";
			$nb = $this->IDC->exec ( $req );
		}
		return $nb;
	}
	
	public function getCommentaireS() {
		// recupere TOUS LES commentaires de la BDD
		if ($this->IDC) {
			$result = $this->IDC->query ("
				SELECT u.pseudo, jv.nomjv, c.libelle FROM commentaire c
				INNER JOIN users u on u.idU = c.idU
				INNER JOIN jeuxvideos jv on jv.idJV = c.idJV
				WHERE valide = 1;
			");
			return $result;
		}
	}
	
		public function getCommentairesInvalides() {
		// recupere TOUS LES commentaires de la BDD
		if ($this->IDC) {
			$result = $this->IDC->query ("
				SELECT u.pseudo, jv.nomjv, c.libelle, c.idu, c.idjv FROM commentaire c
				INNER JOIN users u on u.idU = c.idU
				INNER JOIN jeuxvideos jv on jv.idJV = c.idJV
				WHERE valide = 0;
			");
			return $result;
		}
	}
	
	public function getCommentairesIdjv($idJ) {
		// recupere TOUS LES commentaires  POUR UN JEU
		if ($this->IDC) {
			$result = $this->IDC->query ( "
				SELECT c.idJV as IDJV, c.idU as IDU, u.pseudo as PSEUDO, c.libelle as LIBELLE 
				FROM commentaire c
				INNER JOIN users u on u.idU = c.idU
				where c.idJV = ".$idJ."
				AND valide = 1;
			" ); //MRequête SQL modifiée avant de pouvoir récupérer le pseudo de la personne associée au commentaire
			return $result;
		}
	}
	public function delete($idu,$idjv) {
		//supression d'un commentaire à l'aide de ces 2 identifiants
		if ($this->IDC) {
			$this->IDC->exec ( "DELETE FROM commentaire WHERE idu = ".$idu ." and idjv = ".$idjv.";");
		}
	}
	
}
