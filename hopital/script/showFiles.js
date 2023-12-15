/**
 * Fonction appelée lors du clic sur l'icône de fichier et qui créer la div de dépôt de fichier
 * @param {Event} e 
 */
show_files = function(e) {
	// récupération des différents éléments par rapport à l'élément cliqué
	let icon = event.target;
	let grille = icon.parentNode.parentNode.parentNode;
	let div = grille.parentNode;
	if (grille.nextSibling != null) { // si on est pas au dernier rdv de la liste
		if (grille.nextSibling.classList.length == 0) { // si la div suivante n'est pas une div de liste de fichiers ou une div de dépôt
			// Création de la div de dépôt de fichier
			let new_grille = createDivDepot();
			div.insertBefore(new_grille, grille.nextSibling);
			setTimeout(function() {
				new_grille.style.maxHeight = "60vh";
			}, 50);
		} else { // Sinon on supprime la/les divs
			if (grille.nextSibling.style.maxHeight == "0px")
				return;
			let temp = grille.nextSibling.nextSibling;
			// Si il y a une div de liste de fichiers, on supprime les deux divs
			if (temp && temp.classList.length) {
				temp.style.maxHeight = 0;
				grille.nextSibling.style.maxHeight = 0;
				setTimeout(function() {
					grille.nextSibling.remove();
				}, 1000);
				setTimeout(function() {
					temp.remove();
				}, 500);
			} else { // Sinon on supprime la div de dépôt
				grille.nextSibling.style.maxHeight = 0;
				setTimeout(function() {
					grille.nextSibling.remove();
				}, 500);
			}
			return;
		}
	} else { // si on est au dernier rdv de la liste
		let new_grille = createDivDepot();
		div.insertBefore(new_grille, grille.nextSibling);
		setTimeout(function() {
			new_grille.style.maxHeight = "60vh";
		}, 50);
	}
	refreshEventDrop(); // Rafraichissement des évènements de drop
	let id = grille.childNodes[0].childNodes[0].innerHTML;
	// Si le rdv possède déjà des fichiers, on les affiche
	getFiles(id).then(donnees => {
		if (donnees.length == 0) return;
		let liste = document.createElement("div");
		liste.classList.add("liste");
		for (let i = 0; i < donnees.length; i++) {
			let ligne = Object.values(donnees[i]);
			let new_div = document.createElement("div");
			new_div.classList.add("line-file");
			let paragraph = document.createElement("p");
			paragraph.textContent = ligne[1];
			new_div.appendChild(paragraph);
			let suppr = document.createElement("i");
			suppr.classList.add("fa-solid", "fa-trash");
			new_div.appendChild(suppr);
			let down = document.createElement("i");
			down.classList.add("fa-solid", "fa-cloud-arrow-down");
			new_div.appendChild(down);
			let id_file = document.createElement("p");
			id_file.style.display = "none";
			id_file.textContent = ligne[0];
			new_div.appendChild(id_file);
			liste.appendChild(new_div);
		}
		div.insertBefore(liste, grille.nextSibling);
		setTimeout(function() {
			liste.style.maxHeight = "60vh";
		}, 50);
		refreshDeleteFilesEvent();
	});
	// Les setTimeout sont là pour permettre l'animation des différentes divs
}

/**
 * Fonction qui créer la div de dépôt de fichier
 * @returns {HTMLDivElement} La div de dépôt de fichier
 */
function createDivDepot() {
	let new_grille = document.createElement("div");
	new_grille.classList.add("listFiles");
	let new_div = document.createElement("div");
	new_div.classList.add("depot");
	new_div.setAttribute("ondrop", "drop(event)");
	let new_p = document.createElement("p");
	new_p.textContent = "Déposer le fichier de résultat de l'examen";
	new_div.appendChild(new_p);
	new_grille.appendChild(new_div);
	return new_grille;
}
