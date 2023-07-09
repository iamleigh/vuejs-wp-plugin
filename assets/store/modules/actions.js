import axios from 'axios';

export const actions = {
	ADD_EMAIL: async ({ commit }, payload) => {
		const emailNew = {
			id: payload.id,
			value: payload.value,
		};

		commit('ADD_EMAIL', emailNew);
	},

	REMOVE_EMAIL: async ({ commit }, payload) => {
		commit('REMOVE_EMAIL', payload);
	},

	SAVE_SETTINGS: async ({ commit }, payload) => {
		const url = `${lqAdminLocalizer.apiUrl}/lq/v1/settings`;

		commit('SAVING_SETTINGS');

		axios
			.post(url, {
				tablerows: payload.tablerows,
				timestamp: payload.timestamp,
				emails: payload.emails,
			})
			.then(() => {
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

	FETCH_MESSAGES: async ({ commit }, payload) => {
		const url = `${lqAdminLocalizer.apiUrl}/lq/v1/messages`;

		axios
			.get(url)
			.then((res) => {
				payload = res.data;
				commit('UPDATE_MESSAGES', res.data);
			})
			.catch((err) => {
				console.log(err);
			});
	},
};
