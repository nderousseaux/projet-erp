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
			idGroland INTEGER,
			dateHeure DATETIME,
			examen TEXT,
			patient TEXT,
			metadata1 TEXT,
			metadata2 TEXT,
			mutuelle TEXT,
			montant INTEGER,
			confirme BOOLEAN DEFAULT 0,
			payeDMI BOOLEAN DEFAULT 0,
			payeMutuelle BOOLEAN DEFAULT 0
		)");

		// Création de la table du stockage des fichiers si elle n'existe pas
		$this->pdo->exec("CREATE TABLE IF NOT EXISTS files (
			id INTEGER PRIMARY KEY AUTOINCREMENT,
			name TEXT,
			related_to INTEGER,
			content BLOB,
			FOREIGN KEY(related_to) REFERENCES hopital(id)
		)");
	}

	public function newAppointment(
		$idGroland, $dateHeure, $examen, $patient, $metadata1, $metadata2,
		$mutuelle, $montant
	) {
		// Récupère les données du formulaire
		$idGroland = htmlspecialchars($idGroland);
		$dateHeure = htmlspecialchars($dateHeure);
		$examen = htmlspecialchars($examen);
		$patient = htmlspecialchars($patient);
		$metadata1 = htmlspecialchars($metadata1);
		$metadata2 = htmlspecialchars($metadata2);
		$mutuelle = htmlspecialchars($mutuelle);
		$montant = htmlspecialchars($montant);


		$dateFormatee = DateTime::createFromFormat("Y-m-d\TH:i", $dateHeure);
		$dateHeure = $dateFormatee->format("Y-m-d H:i");

		// Ajoute le rendez-vous à la base de données
		$stmt = $this->pdo->prepare("
			INSERT INTO hopital (idGroland, dateHeure, examen, patient,
				metadata1, metadata2, mutuelle, montant)
			VALUES (:idGroland, :dateHeure, :examen, :patient, :metadata1,
				:metadata2, :mutuelle, :montant)
		");

		$stmt->bindParam(":idGroland", $idGroland);
		$stmt->bindParam(":dateHeure", $dateHeure);
		$stmt->bindParam(":examen", $examen);
		$stmt->bindParam(":patient", $patient);
		$stmt->bindParam(":metadata1", $metadata1);
		$stmt->bindParam(":metadata2", $metadata2);
		$stmt->bindParam(":mutuelle", $mutuelle);
		$stmt->bindParam(":montant", $montant);
		$stmt->execute();

		// Récupère l'id du rendez-vous
		$id = $this->pdo->lastInsertId();
		return $id;
	}


	/**
	 * Récupère metadata1
	 */
	public function getMetadata2($id) {
		$stmt = $this->pdo->prepare("
			SELECT metadata2 FROM hopital WHERE id = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Récupère le montant de l'acte
	 */
	public function getMontant($id) {
		$stmt = $this->pdo->prepare("
			SELECT montant FROM hopital WHERE id = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Récupère la date et l'heure du rendez-vous
	 */
	public function getDate($id) {
		$stmt = $this->pdo->prepare("
			SELECT dateHeure FROM hopital WHERE id = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Récupère le type d'examen
	 */
	public function getExamen($id) {
		$stmt = $this->pdo->prepare("
			SELECT examen FROM hopital WHERE id = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Récupère l'id Groland du patient
	 */
	public function getIdGroland($id) {
		$stmt = $this->pdo->prepare("
			SELECT idGroland FROM hopital WHERE id = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Réupère si la DMI a payé
	 */
	public function getPayeDMI($id) {
		$stmt = $this->pdo->prepare("
			SELECT payeDMI FROM hopital WHERE id = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Réupère si la mutuelle a payé
	 */
	public function getPayeMutuelle($id) {
		$stmt = $this->pdo->prepare("
			SELECT payeMutuelle FROM hopital WHERE id = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Indique que la DMI a payé
	 */
	public function setPayeDMI($id) {
		$stmt = $this->pdo->prepare("
			UPDATE hopital SET payeDMI = 1 WHERE id = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();
	}

	/**
	 * Indique que la mutuelle a payé
	 */
	public function setPayeMutuelle($id) {
		$stmt = $this->pdo->prepare("
			UPDATE hopital SET payeMutuelle = 1 WHERE id = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();
	}

	/**
	 * Récupère le tarif de l'acte
	 */
	public function getTarif($id) {
		$stmt = $this->pdo->prepare("
			SELECT montant FROM hopital WHERE id = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Récupère les rendez-vous prévus (confirmé à 0 ou null)
	 * @return array
	 */
	public function getScheduledAppointment() {
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
	public function getConfirmedAppointment() {
		$stmt = $this->pdo->prepare("
			SELECT * FROM hopital
			WHERE confirme = 1 AND dateHeure > datetime('now')
		");

		$stmt->execute();

		// Récupère le tableau associé
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Récupère les rendez-vous passés (date et heure passés)
	 * @return array
	 */
	public function getPassedAppointment() {
		$stmt = $this->pdo->prepare("
			SELECT * FROM hopital
			WHERE confirme = 1 AND dateHeure <= datetime('now')
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
	public function confirmAppointment($id) {
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

	/**
	 * Ajoute un fichier pour un certain rendez-vous dans la BDD de fichiers
	 * @param  int $id ID du rendez-vous
	 * @param  string $filename Nom du fichier
	 * @param  string $content Contenu du fichier@
	 */
	public function sendFile($id, $filename, $content) {
		// Le decodoage est pas utile, plus jolie de laisser encoder dans la base de données
		// $contenu = base64_decode($content);

		$stmt = $this->pdo->prepare("
			INSERT INTO files (name, related_to, content) VALUES (:filename, :id, :content)
		");

		$stmt->bindParam(":filename", $filename);
		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":content", $content);
		$stmt->execute();
	}

	/**
	 * Récupère les fichiers d'un rendez-vous
	 * @param  int $id ID du rendez-vous
	 * @return array Tableau associatif contenant les fichiers
	 */
	public function getFiles($id) {
		$stmt = $this->pdo->prepare("
			SELECT id, name FROM files WHERE related_to = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function deleteFile($id) {
		$stmt = $this->pdo->prepare("
			DELETE FROM files WHERE id = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();
	}

	public function downloadFile($id) {
		$stmt = $this->pdo->prepare("
			SELECT content FROM files WHERE id = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
