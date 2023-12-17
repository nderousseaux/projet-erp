<?php
// Classe permettant les opérations avec la bdd
class AccessBdd {
	private $pdo;

	public function __construct() {
		// Chemin vers le fichier de la base de données
		$host = "db";
		$dbname = 'dmi';
		$port = 3306;
		$dsn = "mysql:host=$host;port=$port;dbname=$dbname";
		$user = 'user';
		$pwd = 'password';
		
		// Connexion à la base de données
		$this->pdo = new PDO($dsn, $user, $pwd);

		// Création de la table si elle n'existe pas
		$this->pdo->exec("CREATE TABLE IF NOT EXISTS patient (
			id_grld INT NOT NULL,
			name VARCHAR(50) NOT NULL,
			firstname VARCHAR(50) NOT NULL,
			pwd VARCHAR(100) NOT NULL,
			PRIMARY KEY (id_grld)
		)");
		
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS acte (
            id INT NOT NULL,
            id_grld INT NOT NULL,
            place VARCHAR(50) NOT NULL,
            actetype VARCHAR(50) NOT NULL,
            date DATETIME NOT NULL,
            notes VARCHAR(200),
            price FLOAT NOT NULL,
            remaining FLOAT,
            confirmed TINYINT DEFAULT 0,
			PRIMARY KEY (id),
			FOREIGN KEY(id_grld) REFERENCES patient(id_grld) ON DELETE CASCADE
        )");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS files (
            id INT NOT NULL AUTO_INCREMENT,
            name TEXT NOT NULL,
            related_to INTEGER,
            content BLOB,
			PRIMARY KEY (id),
            FOREIGN KEY(related_to) REFERENCES acte(id) ON DELETE CASCADE
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
			VALUES (:id, :name, :firstname, :mdp)
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
			return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
		}
		else {
			return null;
		}
	}

	/**
	 * Check si le mot de passe est celui associé au patient
	 * @return 1 si c'est le bon mot de passe, 0 sinon
	 */
	public function checkconnect($id, $pwd) {
		$stmt = $this->pdo->prepare("
			SELECT count(*) FROM patient 
			WHERE id_grld = :id and pwd = :mdp
		");
		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":mdp", $pwd);

		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_NUM)[0];
		return $count;
	}

	/**
	 * Récupère les actes du patient renseigné
	 * @return true si la commande a réussi
	 * @return false sinon
	 */
	public function createacte($id, $id_grld, $lieu, $type, $date, $notes, $montant) {
		$restant = floatval($montant)/2;

		$stmt = $this->pdo->prepare("
			INSERT INTO acte 
			(id, id_grld, place, actetype, date, notes, price, remaining)
			VALUES 
			(:id, :id_grld, :lieu, :type, :date, :notes, :montant, :rst)
		");
		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":id_grld", $id_grld);
		$stmt->bindParam(":lieu", $lieu);
		$stmt->bindParam(":type", $type);
		$stmt->bindParam(":date", $date);
		$stmt->bindParam(":notes", $notes);
		$stmt->bindParam(":montant", $montant);
		$stmt->bindParam(":rst", $restant);


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
			SELECT id as id_acte, id_grld as id_graulandais, place AS lieu,
			actetype AS type, date, notes,
			FORMAT(price, 2) AS prix,
			FORMAT(remaining, 2) AS restant,
			confirmed AS confirme
			FROM acte WHERE id_grld = :id 
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
			return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
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
			SELECT FORMAT(remaining, 2) AS restant FROM acte WHERE id = :id
		");

		$stmt->bindParam(":id", $id);
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
		return $res;
	}

	/**
	 * Paye un acte d'un montant indiqué, en récupérant 
	 * @return true si le montant a été payé
	 * @return false sinon
	 */
	public function pay($id, $amount) {
		$remaining = floatval($this->getRemaining($id)["restant"]);
		$res = $remaining - floatval($amount);
		if ($res <= 0) {
			$res = 0;
		}
		$stmt = $this->pdo->prepare("
			UPDATE acte SET remaining = :reste
			WHERE id = :id
		");
		$stmt->bindParam(":reste", $res);
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $res;
	}
}
?>