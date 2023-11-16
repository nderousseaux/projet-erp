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

		$this->pdo->exec("CREATE TABLE IF NOT EXISTS files (
			id INTEGER PRIMARY KEY AUTOINCREMENT,
			name TEXT,
			related_to INTEGER,
			content BLOB,
			FOREIGN KEY(related_to) REFERENCES hopital(id)
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

	public function sendFile($id, $filename, $content) {
		// Le decodoage est pas utile, plus jolie de laisser encoder dans la base de données
		$contenu = base64_decode($content);

		$stmt = $this->pdo->prepare("
			INSERT INTO files (name, related_to, content) VALUES (:filename, :id, :content)
		");

		$stmt->bindParam(":filename", $filename);
		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":content", $content);
		$stmt->execute();
	}

	public function getFiles($id) {
		$stmt = $this->pdo->prepare("
			SELECT id, name FROM files WHERE related_to = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
