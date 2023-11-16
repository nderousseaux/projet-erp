function sendFile(id, filename, content) {
	return new Promise((resolve, reject) => {
		let champPost = new FormData();
		champPost.append("id", id);
		champPost.append("filename", filename);
		champPost.append("content", content);

		if (champPost.values.length != 3) {
			console.log("error 3 args required");
			return;
		}

		fetch("../backend/sendFile.php", {
			method: "POST",
			body: champPost
		})
	})
}