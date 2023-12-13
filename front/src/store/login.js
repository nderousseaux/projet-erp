import api from '@/api';

const state = () => ({
	token: "",
	error: "",
	loading: false,
});

const getters = {
	getToken: (state) => state.token,
	getLoadingLogin: (state) => state.loading,
	getErrorLoginMessage: (state) => state.error,
};

const actions = {
	async login({ commit }, { username, password }) {
		commit('setLoading', true);
		try {
			const response = await api.login.login(username, password);
			console.log(response);
			commit('setToken', response);
			commit('setError', "");
		} catch (error) {
			commit('setError', error.message);
		}
		commit('setLoading', false);
	},

	async logout({ commit }) {
		commit('setToken', "");
		commit('setError', "");
	},

	async signin({ commit }, { name,
		firstname,
		address,
		timestamp,
		placeBirth,
		password,
		passwordVerif }) {
		commit('setLoading', true);
		try {
			const response = await api.login.signin(name,
				firstname,
				address,
				timestamp,
				placeBirth,
				password,
				passwordVerif);
			console.log(response);
			commit('setError', "");
		} catch (error) {
			commit('setError', error.message);
		}
		commit('setLoading', false);
	},
};

const mutations = {
	setToken: (state, token) => (state.token = token),
	setLoading: (state, loading) => (state.loading = loading),
	setError: (state, error) => (state.error = error),
};

export default {
  state,
	getters,
	actions,
	mutations,
}