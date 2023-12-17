/**
 * Récupère les rendez-vous dans la BDD en faisant appel à un fichier dans le
 * backend
 * Est envoyé en argument le type de rendez-vous que l'on souhaite récupérer
 * @param {string} typeRdv type de rendez-vous à récupérer
 * 							(prevus, confirmes, passes)
 * @returns un JSON des données récupérées
 */
function getAppointment(typeRdv) {
	return new Promise((resolve, reject) => {
		// Champ à envoyer au back, pour indiquer la colonne à récupérer
		let champPost = new FormData();
		champPost.append("typeRdv", typeRdv);

		// Récupère les dates des mesures et les données de la colonne demandée
		fetch("../backend/getAppointment.php", {
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
