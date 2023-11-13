function refreshEventDrop() {
	let depot = document.getElementsByClassName("depot");
	
	for (let i = 0; i < depot.length; i++) {
		depot[i].addEventListener('dragover', (e) => {
			e.preventDefault();
			depot[i].classList.add("drop");
		});

		depot[i].addEventListener('dragleave', (e) => {
			e.preventDefault();
			depot[i].classList.remove("drop");
		});
	}
}

function drop(event) {
	event.preventDefault();	
	if (event.target.tagName != "DIV")
		event.target.parentNode.classList.remove("drop");
	else
		event.target.classList.remove("drop");
	console.log(event.dataTransfer.files);
	switch (event.dataTransfer.files.length) {
		case 0:
			alert("Ce qui a été déposé n'est pas un fichier");
			return;
			break;
		case 1:
			break;
		default:
			alert("Plus de 1 fichier a été déposé");
			return;
			break;
	}
	// Recherche de l'id sur la div du haut
	let id = event.target;
	if (id.tagName != "DIV")
		id = id.parentNode;
	id = id.parentNode.previousSibling.childNodes[0].childNodes[0].innerHTML;
	console.log(id);

	let file = event.dataTransfer.files[0];
	let filename = file.name;
	let reader = new FileReader();
	reader.onload = function(e) {
		let content = e.target.result.split(',')[1];
		sendFile(id,filename,content);
	}
	reader.readAsDataURL(file);
}
