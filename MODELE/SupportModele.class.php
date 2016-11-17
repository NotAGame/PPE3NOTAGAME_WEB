<?php
require_once '../Class/Connexion.class.php';

class SupportModele {

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
	public function getSupports()
	{
		if ($this->conn)
		{
			$req = $this->conn->query("SELECT * FROM support ORDER BY NOMS");
			$res = $req->fetchAll();
			$req->closeCursor();
			return $res;
		}
	}
}