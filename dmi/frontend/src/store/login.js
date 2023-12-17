import api from '@/api';

const state = () => ({
	login: false,
	error: "",
	loading: false,
	id: "",
});

const getters = {
	getToken: (state) => state.login,
	getLoadingLogin: (state) => state.loading,
	getErrorLoginMessage: (state) => state.error,
	getId: (state) => state.id,
};

const actions = {
	async login({ commit }, { username, password }) {
		commit('setLoadingLogin', true);
		try {
			const response = await api.login.login(username, password);
			if (response.data == 1)
				throw new Error(response, "Login failed");
			commit('setLogin', true);
			commit('setId', username);
			commit('setError', "");
		} catch (error) {
			commit('setError', error.message);
		}
		commit('setLoadingLogin', false);
	},

	async logout({ commit }) {
		commit('setLogin', false);
		commit('setId', "");
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
			if (password != passwordVerif)
				throw new Error("Passwords don't match");

			const response = await api.login.signin(
				id,
				name,
				firstname,
				password,);
			if (response.data[0] != 0)
				throw new Error(response, "Signin failed");
			commit('setError', "");
		} catch (error) {
			commit('setError', error.message);
		}
		commit('setLoadingLogin', false);
	},
};

const mutations = {
	setId: (state, id) => (state.id = id),
	setLogin: (state, token) => (state.login = token),
	setLoadingLogin: (state, loading) => (state.loading = loading),
	setError: (state, error) => (state.error = error),
};

export default {
  state,
	getters,
	actions,
	mutations,
}