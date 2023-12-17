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
		commit('setLoadingLogin', true);
		try {
			const response = await api.login.login(username, password);
			console.log(response);
			commit('setToken', response);
			commit('setError', "");
		} catch (error) {
			commit('setError', error.message);
		}
		commit('setLoadingLogin', false);
	},

	async logout({ commit }) {
		commit('setToken', "");
		commit('setError', "");
	},

	async signin({ commit }, {
		id,
		name,
		firstname,
		password,
		passwordVerif }) {
		commit('setLoadingLogin', true);
		try {
			const response = await api.login.signin(
				id,
				name,
				firstname,
				password,
				passwordVerif);
			console.log(response);
			commit('setError', "");
		} catch (error) {
			commit('setError', error.message);
		}
		commit('setLoadingLogin', false);
	},
};

const mutations = {
	setToken: (state, token) => (state.token = token),
	setLoadingLogin: (state, loading) => (state.loading = loading),
	setError: (state, error) => (state.error = error),
};

export default {
  state,
	getters,
	actions,
	mutations,
}