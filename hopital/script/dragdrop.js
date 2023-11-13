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
}
