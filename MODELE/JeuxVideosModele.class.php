<?php
require_once '../Class/Connexion.class.php';

class jeuxVideosModele {

	private $idcJV = null;

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$ConnexionJV = new Connexion();
			$this->idcJV = $ConnexionJV->IDconnexion;
		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}
	public function add($nomjv,$anneesortie,$classification,$editeur,$description) {
		// ajoute ce jeux videos dans la BDD
		$nb = 0;
		if ($this->idcJV) {
			$req = "INSERT INTO jeuxvideos(`nomjv`, `anneesortie`, `classification`, `editeur`,`description`) VALUES  ('" . $nomjv . "','" . $anneesortie . "','" . $classification . "');";
			$nb = $this->idcJV->exec($req);
		}
		return $nb; // si nb =1 alors l'insertion s est bien passee
	}
	public function getID($nomjv,$anneesortie) {
		// recupere l'id du jeux videos correspondant à  au nom et à l'année de sortie
		if ($this->idcJV) {
			$req= "SELECT idjv from jeuxvideos where nomjv=" . $nomjv . " and anneesortie=". $anneesortie . ";" ;
			$resultID = $this->idcJV->query($req);
			return $resultID;
		}
	}
	public function getJeuxVideoParGenres($genres)
	{
		if ($this->idcJV)
		{
			$qMarks = str_repeat('?,', count($genres) - 1) . '?';
			$req = $this->idcJV->prepare("SELECT J.IDJV, NOMJV, ANNEESORTIE, EDITEUR FROM jeuxvideos J INNER JOIN classer ON (J.idjv = classer.idjv) WHERE classer.idg IN (" . $qMarks . ") GROUP BY J.IDJV ORDER BY nomjv, anneesortie");
			$req->execute($genres);
			$res = $req->fetchAll();
			$req->closeCursor();
			return $res;
		}
	}

	public function getJeuxVideoParNotes() {
		// recupere TOUS LES jeux vidéos de la BDD
		if ($this->idcJV) {
			$req ="SELECT jeuxvideos.idjv, nomjv, anneesortie, description, AVG(note) noteMoy FROM jeuxvideos LEFT JOIN noter ON (jeuxvideos.idjv = noter.idjv) GROUP BY nomjv ORDER BY noteMoy DESC";
			$resultJV = $this->idcJV->query($req);
			return $resultJV;
		}
	}

	public function getJeuxVideoS() {
		// recupere TOUS LES jeux vidéos de la BDD
		if ($this->idcJV) {
			$req ="SELECT * FROM jeuxvideos ORDER BY nomjv AND anneesortie";
			$resultJV = $this->idcJV->query($req);
			return $resultJV;
		}
	}
}