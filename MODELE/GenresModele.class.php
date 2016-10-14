<?php
require_once '../Class/Connexion.class.php';

class GenresModele {

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
	public function getGenres()
	{
		if ($this->conn)
		{
			$req = $this->conn->query("SELECT * FROM genre");
			$res = $req->fetchAll();
			$req->closeCursor();
			return $res;
		}
	}
	public function getJeuxVideoS() {
		// recupere TOUS LES jeux vidéos de la BDD
		if ($this->idcJV) {
			$req ="SELECT * from jeuxvideos ORDER BY nomjv, anneesortie;" ;
			$resultJV = $this->idcJV->query($req);
			return $resultJV;
		}
	}
}