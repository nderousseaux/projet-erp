const checkboxes = document.querySelectorAll("li input[type='checkbox']");
const ul = document.querySelector("ul");

checkboxes.forEach((checkbox) => {
	checkbox.addEventListener("change", () => {
		if (checkbox.checked) {
			console.log("Checkbox cochée");
			const li = checkbox.parentNode;

			li.parentNode.removeChild(li);

			if (ul.childElementCount === 0) {
				const message = document.createElement("p");
				message.textContent = "Il n'y a plus de rendez-vous à traiter";
				ul.appendChild(message);
			}
		}
	});
});