<?php
// COMMENT CONTACTER LA MUTUELLE ? => dans création patient ?
// 
class AccesBdd {
	private $pdo;

	public function __construct() {
		// Chemin vers le fichier de la base de données
		$db_file = "bdd/dmi.db";

		// Connexion à la base de données
		$this->pdo = new PDO("sqlite:$db_file");

		// Création de la table si elle n'existe pas
		$this->pdo->exec("CREATE TABLE IF NOT EXISTS patient (
			id_grld INTEGER PRIMARY KEY,
			name TEXT NOT NULL,
			firstname TEXT NOT NULL,
			pwd TEXT NOT NULL,
		)");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS acte (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            id_grld INTEGER,
            place TEXT NOT NULL,
            actetype TEXT NOT NULL,
            date DATE NOT NULL,
            notes TEXT,
            price FLOAT NOT NULL,
            remaining FLOAT,
            confirmed TINYINT DEFAULT 0,
			FOREIGN KEY(id_grld) REFERENCES patient(id_grld),
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS files (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            related_to INTEGER,
            content BLOB,
            FOREIGN KEY(related_to) REFERENCES acte(id)
        )");
	}

	/**
	 * Récupère les actes du patient renseigné
	 * @return true si l'ajout a fonctionné
	 * @return false sinon
	 */
	public function createdmi($id, $name, $firstname, $mdp) {
		$stmt = $this->pdo->prepare("
			INSERT INTO patient (id_grld, name, firstname, pwd)
			VALUES (:id, :name, :firstname, :mdp);
		");

		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":name", $name);
		$stmt->bindParam(":firstname", $firstname);
		$stmt->bindParam(":mdp", $mdp);
		$success = $stmt->execute();

		// Retourne le succès ou non de l'ajout
		return $success;
	}

	/**
	 * Récupère le dmi du patient renseigné, null s'il n'existe pas
	 * @return array
	 */
	public function finddmi($id) {
		$stmt = $this->pdo->prepare("
			SELECT * FROM patient where id_grld = :id
		");
		$stmt->bindParam(":id", $id);
		$stmt->execute();
		$count = $stmt->rowCount();

		// On retourne le dmi s'il existe
		if ($count == 1) {
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		else {
			return null;
		}
	}

	/**
	 * Check si le mot de passe est celui associé au patient
	 * @return 1 si c'est le bon mot de passe, 0 sinon
	 */
	public function checkpassword($id, $pwd) {
		$stmt = $this->pdo->prepare("
			SELECT count(*) FROM patient 
			WHERE id_grld = :id and pwd = :mdp
		");

		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_NUM)[0];

		if($count == 1) {
			return 1;
		}
		else {
			return 0;
		}
	}

	/**
	 * Récupère les actes du patient renseigné
	 * @return true si la commande a réussi
	 * @return false sinon
	 */
	public function createacte($id, $lieu, $date, $type, $notes, $montant) {

		$stmt = $this->pdo->prepare("
			INSERT INTO acte 
			(id_grld, place, actetype, date, notes, price, remaining)
			VALUES (:id, :lieu, :type, :date, :notes, :montant, :montant)
		");
		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":lieu", $lieu);
		$stmt->bindParam(":date", $date);
		$stmt->bindParam(":type", $type);
		$stmt->bindParam(":notes", $notes);
		$stmt->bindParam(":montant", $montant);

		$success = $stmt->execute();
		
		// Retourne le succès ou non de la création
		return $success; 
	}

	/**
	 * Récupère les actes du patient renseigné
	 * @return array
	 */
	public function getActes($id_grld) {
		$stmt = $this->pdo->prepare("
			SELECT * FROM acte WHERE id_grld = :id 
		");
		$stmt->bindParam(":id", $id_grld);
		$stmt->execute();

		// Récupère le tableau associé
		return  $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Récupère un acte via son identifiant
	 * @return array s'il existe, null sinon
	 */
	public function getActe($id) {
		$stmt = $this->pdo->prepare("
			SELECT * FROM acte WHERE id = :id 
		");
		$stmt->bindParam(":id", $id);

		$stmt->execute();
		$count = $stmt->rowCount();

		// Récupère le tableau associé
		if ($count == 1) {
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} 
		else {
			return null;
		}
	}

	/**
	 * Confirme un acte via son identifiant
	 * @return true si l'acte a été confirmé
	 * @return false sinon
	 */
	public function confirmAct($id) {
		$stmt = $this->pdo->prepare("
			UPDATE acte SET confirmed = 1 WHERE id = :id
		");

		$stmt->bindParam(":id", $id);
		$success = $stmt->execute();

		return $success;
	}

	/**
	 * Retourne le reste à payer d'un acte
	 * @return array le montant restant à payer
	 */
	public function getRemaining($id) {
		$stmt = $this->pdo->prepare("
			SELECT remaining FROM acte WHERE id = :id
		");

		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Paye un acte d'un montant indiqué
	 * @return true si le montant a été payé
	 * @return false sinon
	 */
	public function pay($id, $amount) {
		$stmt = $this->pdo->prepare("");
	}
}
