const depot = document.getElementById("depot");

depot.addEventListener('dragover', (e) => {
	e.preventDefault();
	depot.classList.add("drop");
});

depot.addEventListener('dragleave', (e) => {
	e.preventDefault();
	depot.classList.remove("drop");
});

function drop(event) {
	event.preventDefault();	
	depot.classList.remove("drop");
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
}
