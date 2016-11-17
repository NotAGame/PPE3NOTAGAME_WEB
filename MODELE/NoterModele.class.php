<?php
require_once '../Class/Connexion.class.php';

class NoterModele {

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
	public function noterJeu($idJeu, $idUser, $note)
	{
		if ($this->conn)
		{
			$req = $this->conn->prepare("INSERT INTO noter (idjv, idUser, note) VALUES (?, ?, ?)");
			$req->execute([$idJeu, $idUser, $note]);
		}
	}
}