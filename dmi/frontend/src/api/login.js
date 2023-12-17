import axios from 'axios';

export default {
	login: (username, password) => {
		let formData = new FormData();
		formData.append('id', username);
		formData.append('password', password);
		return axios.post('loginuser.php', formData)
	},
	signin: (
		id,
		name,
		firstname,
		password) => {
			let formData = new FormData();
			formData.append('idGroland', id);
			formData.append('nom', name);
			formData.append('prenom', firstname);
			formData.append('mdp', password);
			return axios.post('createdmi.php', formData);
		},
}