import _ from 'lodash';

import api from '@/api';

const state = () => ({
	meds: {},
	loading: false,
});

const getters = {
	getMeds: (state) => state.meds,
	getLoading: (state) => state.loading,
	getMedsPrevu: (state) => {
		return _.filter(state.meds, { 'isPass': false });
	},
	getMedsPass: (state) => {
		return _.filter(state.meds, { 'isPass': true });
	},
};

const actions = {
	async fetchMeds({ commit }) {
		commit('setLoading', true);
		const response = await api.med.getAll();
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