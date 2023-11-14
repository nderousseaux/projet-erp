afficherRdv("prevus");
afficherRdv("confirmes");
afficherRdv("passes");

show_files = function(e) {
	let icon = event.target;
	let grille = icon.parentNode.parentNode.parentNode;
	var div = grille.parentNode;
	if (grille.nextSibling != null) {
		if (grille.nextSibling.classList.length == 0) {
			var new_grille = grille.cloneNode(true);
			new_grille.innerHTML = "<div class=\"depot\" ondrop=\"drop(event)\"><p>Déposer le fichier de résultat de l'examen</p></div>";
			new_grille.classList.add("listFiles");
			div.insertBefore(new_grille, grille.nextSibling);
			setTimeout(function() {
				new_grille.style.maxHeight = "60vh";
			}, 50);
		} else {
			grille.nextSibling.style.maxHeight = 0;
			setTimeout(function() {
				if (grille.nextSibling.classList.contains("listFiles"))
					grille.nextSibling.remove();
			}, 500);
		}
	} else {
		var new_grille = grille.cloneNode(true);
		new_grille.innerHTML = "<div class=\"depot\" ondrop=\"drop(event)\"><p>Déposer le fichier de résultat de l'examen</p></div>";
		new_grille.classList.add("listFiles");
		div.insertBefore(new_grille, grille.nextSibling);
		setTimeout(function() {
			new_grille.style.maxHeight = "60vh";
		}, 50);
	}
	refreshEventDrop();
	let id = grille.childNodes[0].childNodes[0].innerHTML;
	getFiles(id).then(donnees => {
		for (let i = 0; i < donnees.length; i++) {
			let ligne = Object.values(donnees[i]);
			console.log(ligne);
		}
	});
}
