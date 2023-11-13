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
			new_grille.innerHTML = "test";
			new_grille.classList.add("listFiles");
			div.insertBefore(new_grille, grille.nextSibling);
		} else
			grille.nextSibling.remove();
	} else {
		var new_grille = grille.cloneNode(true);
		new_grille.innerHTML = "test";
		new_grille.classList.add("listFiles");
		div.insertBefore(new_grille, grille.nextSibling);
	}
}
