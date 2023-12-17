import sqlite3

# Connexion à la base de données
conn = sqlite3.connect('hopital.db')

# Création d'un curseur pour exécuter des requêtes SQL
cur = conn.cursor()

# Exécution d'une requête SQL pour ajouter des données
cur.execute("""
	CREATE TABLE IF NOT EXISTS hopital
		(
			id INTEGER PRIMARY KEY AUTOINCREMENT, idGrauland INTEGER,
				dateHeure CHAR, examen CHAR, patient CHAR, metadata1 CHAR,
			metadata2 CHAR, mutuelle CHAR, montant FLOAT,
				confirme INT DEFAULT 0, payeDMI INT DEFAULT 0,
				payeMutuelle INT DEFAULT 0
		)
""")
cur.execute("DELETE FROM hopital WHERE dateHeure IS NOT NULL")

cur.execute("""
	INSERT INTO hopital (idGrauland, dateHeure, examen, patient, metadata1,
		metadata2, mutuelle, montant, confirme)
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)""",
	('1234', '2023-09-01 09:05:00', 'X_SCAN_01', 'A1', 'Jambe', 'Méta',
		'MNOP', 200, 1))

cur.execute("""
	INSERT INTO hopital (idGrauland, dateHeure, examen, patient, metadata1,
		metadata2, mutuelle, montant, confirme)
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)""",
	('9876', '2023-09-01 09:57:23', 'X_SCAN_02', 'A2', 'Jambe', 'Méta',
		'MNOP', 200, 1))

cur.execute("""
	INSERT INTO hopital (idGrauland, dateHeure, examen, patient, metadata1,
		metadata2, mutuelle, montant)
	VALUES (?, ?, ?, ?, ?, ?, ?, ?)""",
	('2345','2023-09-01 09:05:00', 'X_SCAN_01', 'A1', 'Jambe', 'Méta',
		'MNOP', 200))

cur.execute("""
	INSERT INTO hopital (idGrauland, dateHeure, examen, patient, metadata1,
		metadata2, mutuelle, montant)
	VALUES (?, ?, ?, ?, ?, ?, ?, ?)""",
	('4567','2023-12-24 09:19:57', 'X_SCAN_02', 'A2', 'Jambe', 'Rotule',
		'MNOP', 200))


cur.execute("""
	INSERT INTO hopital (idGrauland, dateHeure, examen, patient, metadata1,
		metadata2, mutuelle)
	VALUES (?, ?, ?, ?, ?, ?, ?)""",
	('5678', '2023-09-01 09:24:56', 'X_CONS_01', 'A3', 'Bras', 'Lorem-ipsum',
		'IJKJ'))


# Validation de la transaction
conn.commit()

# Fermeture de la connexion à la base de données
conn.close()