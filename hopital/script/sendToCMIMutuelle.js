function sendToCMIMutuelle(cmi, content) {
	return new Promise((resolve, reject) => {
		// Champ à envoyer au back, pour indiquer la colonne à récupérer
		let champPost = new FormData();
		champPost.append("cmi", cmi);
		champPost.append("content", content);

		// Récupère les dates des mesures et les données de la colonne demandée
		fetch("../backend/sendToCMIMutuelle.php", {
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
