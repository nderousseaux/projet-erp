// ** This file is a debugging tool for the front end. 
// It simulates a backend API that returns promises 
// with a delay of 1 second.

let lo = {
	username: "admin",
	password: "admin"
}

export default {
	login: (username, password) => {
		return new Promise((resolve, reject) => {
			setTimeout(() => {
				if (username == lo.username && password == lo.password)
					resolve({token: "1234567890"});
				else
					reject("Wrong username or password");
			}, 1000);
		});
	},
	signin: (name,
		firstname,
		address,
		timestamp,
		placeBirth,
		password,
		passwordVerif) => {
		return new Promise((resolve, reject) => {
			setTimeout(() => {
				if (password == passwordVerif &&
					// Aucun champ null
					name != "" &&
					firstname != "" &&
					address != "" &&
					timestamp != "" &&
					placeBirth != "" &&
					password != "" &&
					passwordVerif != "")
					
					resolve("User created");
				else
					reject("Passwords don't match");
			}, 1000);
		});
	},
}