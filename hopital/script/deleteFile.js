/**
 * Permet d'ajouter les EventListener sur les boutons de suppression de fichier
 */
function refreshDeleteFilesEvent() {
	list = document.getElementsByClassName("fa-trash");
	for (let i = 0; i < list.length; i++)
		list[i].addEventListener("click", prepareDeleteFile, false);
}

prepareDeleteFile = function(e) {
	/*
	// Recherche de l'id du rdv
	let id = e.target.parentNode.parentNode.previousSibling.childNodes[0].childNodes[0].innerHTML;
	*/
	
	// Recherche de l'id du fichier
	let id = e.target.parentNode.childNodes[3].innerHTML;

	deleteFile(id);

	// suppression de la ligne
	e.target.parentNode.remove();
}

function deleteFile(id) {
	return new Promise((resolve, reject) => {
		let champPost = new FormData();
		champPost.append("id", id);

		fetch("../backend/deleteFile.php", {
			method: "POST",
			body: champPost
		})
	})
}
