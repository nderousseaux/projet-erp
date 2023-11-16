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
		let grille = document.createElement("div");
		grille.classList.add("grille");

		let donneesObj = Object.values(donnees[i]);
		for (let y = 0; y < donneesObj.length; y++) {
			let cellule = document.createElement("div");
			cellule.textContent = donneesObj[y];
			cellule.classList.add("colonne");

			if (donneesObj[y] != null)
				grille.appendChild(cellule);
			else {
				let vide = document.createElement("div");
				vide.textContent = "-"
				vide.classList.add("colonne");
				grille.appendChild(vide);
			}

		}
		if (typeRdv == "passes") {
			let icon_files = document.createElement("div");
			icon_files.innerHTML = "<img class=\"file\" src=\"img/file.png\" />";
			icon_files.classList.add("colonne");
			icon_files.addEventListener("click", show_files, false);
			grille.appendChild(icon_files);
		}
		div.appendChild(grille);

		// Si on doit confirmer le rdv, ajoute une checkbox
		if (typeRdv === "prevus") {
			let divCheckbox = document.createElement("div");
			divCheckbox.classList.add("divCheckbox");
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

			divCheckbox.appendChild(checkbox);
			divCheckbox.appendChild(label);
			div.appendChild(divCheckbox);
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
