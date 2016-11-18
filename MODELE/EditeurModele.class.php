<?php
require_once '../Class/Connexion.class.php';

class EditeurModele {

	private $conn = null;

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$ConnexionJV = new Connexion();
			$this->conn = $ConnexionJV->IDconnexion;
		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}
	public function getEditeurs()
	{
		if ($this->conn)
		{
			$req = $this->conn->query("SELECT editeur FROM jeuxvideos ORDER BY editeur");
			$res = $req->fetchAll();
			$req->closeCursor();
			return $res;
		}
	}
}