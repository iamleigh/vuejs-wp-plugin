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
				rowsnumber: '',
				timestamp: '',
			},
		},
		loadingText: 'Save Settings',
	},
	actions,
	getters,
	mutations,
});
