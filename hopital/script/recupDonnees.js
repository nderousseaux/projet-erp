/**
 * Récupère les rendez-vous dans la BDD en faisant appel à un fichier dans le
 * backend
 * Est envoyé en argument le type de rendez-vous que l'on souhaite récupérer
 * @param {string} typeRdv type de rendez-vous à récupérer
 * 							(prevus, confirmes, passes)
 * @returns un JSON des données récupérées
 */
function recupRdv(typeRdv) {
	return new Promise((resolve, reject) => {
		// Champ à envoyer au back, pour indiquer la colonne à récupérer
		let champPost = new FormData();
		champPost.append("typeRdv", typeRdv);

		// Récupère les dates des mesures et les données de la colonne demandée
		fetch("../backend/recupRdv.php", {
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

/**
 * Affiche dans les sections les informations récupérées
 * Dans le cas d'un rendez-vous prévu, une checkbox est ajoutée pour valider
 * le rendez-vous
 * @param {string} typeRdv type de rendez-vous à récupérer
 * 							(prevus, confirmes, passes)
 */
function afficherRdv(typeRdv) {
	recupRdv(typeRdv).then(donnees => {
		// Détermine l'emplacement
		if (typeRdv === "prevus") {
			container = document.getElementById("prevus");
		}
		else if (typeRdv === "confirmes") {
			container = document.getElementById("confirmes");
		}
		else if (typeRdv === "passes") {
			container = document.getElementById("passes");
		}

		// Récupère les valeurs de chaque ligne
		for (let i = 0; i < donnees.length; i++) {
			let div = document.createElement("div");
			let p = document.createElement("p");
			let donneesObj = Object.values(donnees[i]);

			

			for (let y = 0; y < donneesObj.length; y++) {
				if (donneesObj[y] != null) {
					p.textContent += donneesObj[y];

					if (y < donneesObj.length && donneesObj[y + 1] != null) {
						p.textContent += " - ";
					}
				}
			}
			div.appendChild(p);

			// Si on doit confirmer le rdv, ajoute une checkbox
			if (typeRdv === "prevus") {
				let checkbox = document.createElement("input");
				checkbox.type = "checkbox";
				checkbox.id = "confirmer";
				checkbox.name = "confirmer";

				checkbox.onclick = _ => {
					if (checkbox.checked) {
						confirmerRdv(Object.values(donnees[i])[0]);
					}
				};

				// Ajoute un label pour la checkbox
				let label = document.createElement("label");
				label.htmlFor = "confirmer";
				label.appendChild(document.createTextNode("Confirmer"));

				div.appendChild(checkbox);
				div.appendChild(label);
			}

			container.appendChild(div);
		}
	});
}

function confirmerRdv(id) {

	// Champ à envoyer au back, pour indiquer l'id du rdv à confirmer
	let champPost = new FormData();
	champPost.append("id", id);

	// Envoi l'id et vérifie la réponse
	fetch("../backend/confirmerRdv.php", {
		method: "POST",
		body: champPost
	})
	.then(reponse => {
		reponse.json()
			.then(donnees => {
				if (donnees.confirme) {
					location.reload();
				}
			})
			.catch(err => {
				console.log(err);
			})
	})
	.catch(err => {
		reject(err);
	})
}