import Vue from 'vue';
import Vuex from 'vuex';

import { actions } from './modules/actions';
import { getters } from './modules/getters';
import { mutations } from './modules/mutations';

Vue.use(Vuex);

export default new Vuex.Store({
	state: {
		settings: {
			general: {
				tablerows: '',
				timestamp: true,
				emails: [],
			},
		},
		buttonLabel: 'Save Settings',
		saving: false,
	},
	actions,
	getters,
	mutations,
});
