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
				tablerows: '5',
				timestamp: 'unix',
				emails: '',
			},
		},
	},
	actions,
	getters,
	mutations,
});
