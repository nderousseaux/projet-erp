/**
 * Permet d'ajouter les EventListener sur les boutons de téléchargement
 */
function refreshDownloadFilesEvent() {
	list = document.getElementsByClassName("fa-cloud-arrow-down");
	for (let i = 0; i < list.length; i++)
		list[i].addEventListener("click", prepareDownloadFile, false);
}

prepareDownloadFile = function(e) {
	// Recherche de l'id du fichier
	let id = e.target.parentNode.childNodes[3].innerHTML;
	let filename = e.target.parentNode.childNodes[0].innerHTML;

	downloadFile(id).then(donnees => {
		// donnees sous forme : data:application/pdf;base64,...
		console.log(donnees);
		// On supprime le début pour ne garder que le contenu
		var content = donnees[0].content.split(",")[1];
		content = atob(content);
		// On récupère les caractères Unicode
		let tab = new Array(content.length);
		for (let i = 0; i < content.length; i++)
			tab[i] = content.charCodeAt(i);
		content = new Uint8Array(tab);
		// On obtient le type MIME
		let type = donnees[0].content.split(";")[0].split(":")[1];
		let blob = new Blob([content], { type: type });
		let link = document.createElement('a');
		link.href = window.URL.createObjectURL(blob);
		link.download = filename;
		link.click();
	});
}

function downloadFile(id) {
	return new Promise((resolve, reject) => {
		let champPost = new FormData();
		champPost.append("id", id);

		// Recupération du contenu du fichier
		fetch("../backend/downloadFile.php", {
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
				});
		})
		.catch(err => {
			reject(err);
		})
	})
}
