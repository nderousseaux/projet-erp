// ** This file is a debugging tool for the front end. 
// It simulates a backend API that returns promises 
// with a delay of 1 second.

let med = {
	1: {
		date: "2020-01-01",
		time:"12:00",
		place: "Kaiser Permanente",
		intervention: "Surgery",
		notes: "Surgery on left knee",
		fees: 1000,
		remboursement: 800,
		topay: 200,
		confirm: true,
		isPass: false,
		results: "https://www.localhost:8080/resultat/1.pdf"
	},
	2: {
		date: "2020-01-01",
		time:"12:00",
		place: "Kaiser Permanente",
		intervention: "Surgery",
		notes: "Surgery on left knee",
		fees: 1000,
		remboursement: 800,
		topay: 200,
		confirm: true,
		isPass: false,
		results: "https://www.localhost:8080/resultat/2.pdf"
	},
	3: {
		date: "2020-01-01",
		time:"12:00",
		place: "Intermountain",
		intervention: "Surgery",
		notes: "Surgery on left knee",
		fees: 1000,
		remboursement: 800,
		topay: 200,
		confirm: true,
		isPass: true,
		results: "https://www.localhost:8080/resultat/3.pdf"
	},
	4: {
		date: "2020-01-01",
		time:"12:00",
		place: "Kaiser Permanente",
		intervention: "Surgery",
		notes: "Surgery on left knee",
		fees: 1000,
		remboursement: 800,
		topay: 200,
		confirm: true,
		isPass: true,
		results: "https://www.localhost:8080/resultat/4.pdf"
	},
}

export default {
	getAll() {
		return new Promise((resolve) => {
			setTimeout(() => {
				resolve({ data: Object.values(med) });
			}, 1000);
		});			
	},
}