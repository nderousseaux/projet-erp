<?php
class AccesBdd {
	private $pdo;

	public function __construct() {
		// Chemin vers le fichier de la base de données
		$db_file = "bdd/hopital.db";

		// Connexion à la base de données
		$this->pdo = new PDO("sqlite:$db_file");

		// Création de la table si elle n'existe pas
		$this->pdo->exec("CREATE TABLE IF NOT EXISTS hopital (
			id INTEGER PRIMARY KEY AUTOINCREMENT,
			date DATE,
			heure TIME,
			examen TEXT,
			patient TEXT,
			metadata1 TEXT,
			metadata2 TEXT,
			mutuelle TEXT,
			montant INTEGER,
			confirme BOOLEAN,
			reglement INTEGER
		)");
	}

	/**
	 * Récupère les rendez-vous prévus (confirmé à 0 ou null)
	 * @return array
	 */
	public function getRdvPrevus() {
		$stmt = $this->pdo->prepare("
			SELECT * FROM hopital WHERE confirme = 0 OR confirme IS NULL
		");

		$stmt->execute();

		// Récupère le tableau associé
		return  $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Récupère les rendez-vous confirmés (confirmé à 1)
	 * @return array
	 */
	public function getRdvConfirmes() {
		$stmt = $this->pdo->prepare("
			SELECT * FROM hopital WHERE confirme = 1
		");

		$stmt->execute();

		// Récupère le tableau associé
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Récupère les rendez-vous passés (date et heure passés)
	 * @return array
	 */
	public function getRdvPasses() {
		$stmt = $this->pdo->prepare("
			SELECT * FROM hopital
			WHERE date <= date('now') AND heure <= time('now')
		");

		$stmt->execute();

		// Récupère le tableau associé
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Confirme un rendez-vous
	 * @param  int $id ID du rendez-vous à confirmer
	 * @return bool true si la requête a réussi
	 */
	public function confirmerRdv($id) {
		$stmt = $this->pdo->prepare("
			UPDATE hopital SET confirme = 1 WHERE id = :id
		");

		$stmt->bindParam(":id", $id);
		$stmt->execute();


		$stmt = $this->pdo->prepare("
			SELECT confirme FROM hopital WHERE id = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}