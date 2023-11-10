afficherRdv("prevus");
afficherRdv("confirmes");
afficherRdv("passes");

show_files = function(e) {
	let icon = event.target;
	let grille = icon.parentNode.parentNode.parentNode;
	console.log(grille);
	var new_grille = grille.cloneNode(true);
	new_grille.innerHTML = "test";
	grille.parentNode.insertBefore(new_grille, grille.nextSibling);
}
