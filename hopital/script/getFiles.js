function getFiles(id) {
	return new Promise((resolve, reject) => {
		// Envoi une requete POST avec l'id du rendez-vous
		let champPost = new FormData();
		champPost.append("id", id);

		// Recupération des lignes dans la BDD de fichiers associées au rendez-vous
		fetch("../backend/getFiles.php", {
			method: "POST",
			body: champPost
		})
		.then(reponse => {
			reponse.json()
				.then(donnees => {
					resolve(donnees);
				})
				.catch(err => {
					reject(err);
				})
		})
		.catch(err => {
			reject(err);
		})
	})
}
