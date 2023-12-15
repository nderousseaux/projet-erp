/**
 * Rajoute des EventListener sur les nouvelles zones de drop
*/
function refreshEventDrop() {
	// Récupère toutes les zones de drop
	let depot = document.getElementsByClassName("depot");

	for (let i = 0; i < depot.length; i++) {
		// Ajout de la class drop quand la souris est sur la zone
		depot[i].addEventListener('dragover', (e) => {
			e.preventDefault();
			depot[i].classList.add("drop");
		});

		// Suppression de la class drop quand la souris quitte la zone
		depot[i].addEventListener('dragleave', (e) => {
			e.preventDefault();
			depot[i].classList.remove("drop");
		});
	}
}

/**
 * Fonction appelée lors du drop d'un fichier
 * @param {Event} event
*/
function drop(event) {
	event.preventDefault();
	// Suppression de la class drop une fois le fichier déposé
	if (event.target.tagName != "DIV")
		event.target.parentNode.classList.remove("drop");
	else
		event.target.classList.remove("drop");
	console.log(event.dataTransfer.files);
	// Vérification du nombre de fichier déposé
	switch (event.dataTransfer.files.length) {
		case 0:
			alert("Ce qui a été déposé n'est pas un fichier");
			return;
		case 1:
			break;
		default:
			alert("Plus de 1 fichier a été déposé");
			return;
	}
	// Recherche de l'id sur la div du haut
	let id = event.target;
	if (id.tagName != "DIV")
		id = id.parentNode;
	id = id.parentNode.previousSibling;
	if (id.className == "liste")
		id = id.previousSibling;
	id = id.childNodes[0].childNodes[0].innerHTML;
	console.log(id);

	let file = event.dataTransfer.files[0];
	let filename = file.name;
	let reader = new FileReader();
	reader.onload = function(e) {
		// Récupère le contenu du fichier
		let content = e.target.result.split(',')[1];
		sendFile(id,filename,content);
	}
	reader.readAsDataURL(file);
}
