function sendToCMIMutuelle(idLigne) {
	return new Promise((resolve, reject) => {
		// Champ à envoyer au back
		let champPost = new FormData();
		champPost.append("idLigne", idLigne);

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
