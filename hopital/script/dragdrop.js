const depot = document.getElementById("depot");

depot.addEventListener('dragover', (e) => {
    e.preventDefault();
    depot.classList.add("drop");
});

depot.addEventListener('dragleave', (e) => {
    e.preventDefault();
    depot.classList.remove("drop");
});
