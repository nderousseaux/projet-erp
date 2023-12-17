// import _ from 'lodash';

import api from '@/api';

const state = () => ({
	meds: [],
	loading: false,
});

const getters = {
	getMeds: (state) => state.meds,
	getLoading: (state) => state.loading,
	getMedsPrevu: (state) => {
		if (!state.meds)
			return [];
		return state.meds.filter(med => new Date(med.date) > new Date());
	},
	getMedsPass: (state) => {
		if (!state.meds)
			return [];
		return state.meds.filter(med => new Date(med.date) < new Date());
	},
};

const actions = {
	async fetchMeds({ commit }, id) {
		commit('setLoading', true);
		const response = await api.med.getAll(id);
		commit('setMeds', response.data);
		commit('setLoading', false);
	},

};

const mutations = {
	setMeds: (state, meds) => (state.meds = meds),
	setLoading: (state, loading) => (state.loading = loading),
};

export default {
  state,
	getters,
	actions,
	mutations,
}