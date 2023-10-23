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
 * Affiche dans des balises li les informations récupérées
 * Dans le cas d'un rendez-vous prévu, une checkbox est ajoutée pour valider
 * le rendez-vous
 * @param {string} typeRdv type de rendez-vous à récupérer
 * 							(prevus, confirmes, passes)
 */
function afficherRdv(typeRdv) {
	recupRdv(typeRdv).then(donnees => {
		// Détermine l'emplacement
		if (typeRdv === "prevus") {
			ul = document.querySelector("#prevus > ul");
		}
		else if (typeRdv === "confirmes") {
			ul = document.querySelector("#confirmes > ul");
		}
		else if (typeRdv === "passes") {
			ul = document.querySelector("#passes > ul");
		}

		// Récupère les valeurs de chaque ligne
		for (let i = 0; i < donnees.length; i++) {
			li = document.createElement("li");
			li.textContent = "";
			donneesObj = Object.values(donnees[i]);

			for (let y = 0; y < donneesObj.length; y++) {
				if (donneesObj[y] != null) {
					li.textContent += donneesObj[y] + " ";
				}
			}

			// Si on doit confirmer le rdv, ajoute une checkbox
			if (typeRdv === "prevus") {
				let checkbox = document.createElement("input");
				checkbox.type = "checkbox";
				checkbox.id = "confirmer";
				checkbox.name = "confirmer";

				// Ajoute un évenement, si cochée, supprime la ligne
				/*
				 * TODO : Doit marquer dans la bdd que le rdv est confirmé
				 * et l'ajouter à la liste des rdv confirmés
				 */
				checkbox.addEventListener("change", () => {
					ulCheck = document.querySelector("#prevus > ul");
					if (checkbox.checked) {
						console.log("Checkbox cochée");
						const li = checkbox.parentNode;
		
						li.parentNode.removeChild(li);
		
						ulCheck.childElementCount;
						if (ulCheck.childElementCount === 0) {
							const message = document.createElement("p");
							message.textContent =
								"Il n'y a plus de rendez-vous en attente";
							ulCheck.appendChild(message);
						}
					}
				});

				// Ajoute un label pour la checkbox
				let label = document.createElement("label");
				label.htmlFor = "confirmer";
				label.appendChild(document.createTextNode("Confirmer"));

				li.appendChild(checkbox);
				li.appendChild(label);
			}

			ul.appendChild(li);
		}
	});
}