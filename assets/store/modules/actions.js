import axios from 'axios';

export const actions = {
	SAVE_SETTINGS: async ({ commit }, payload) => {
		const url = `${lqAdminLocalizer.apiUrl}/lq/v1/settings`;

		commit('SAVING_SETTINGS');

		axios
			.post(url, {
				tablerows: payload.tablerows,
				timestamp: payload.timestamp,
				emails: payload.emails,
			})
			.then((res) => {
				commit('SAVED_SETTINGS');
			})
			.catch((err) => {
				console.log(err);
			});
	},

	FETCH_SETTINGS: async ({ commit }, payload) => {
		const url = `${lqAdminLocalizer.apiUrl}/lq/v1/settings`;

		axios
			.get(url)
			.then((res) => {
				payload = res.data;
				commit('UPDATE_SETTINGS', res.data);
			})
			.catch((err) => {
				console.log(err);
			});
	},
};
