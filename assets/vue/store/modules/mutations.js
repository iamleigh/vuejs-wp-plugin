export const mutations = {
	ADD_EMAIL: (state, payload) => {
		state.settings.general.emails.push(payload);
	},

	REMOVE_EMAIL: (state, payload) => {
		state.settings.general.emails = state.settings.general.emails.filter(
			(item) => item.id !== payload
		);
	},

	UPDATE_SETTINGS: (state, payload) => {
		state.settings.general = payload;
	},

	SAVED_SETTINGS: (state) => {
		state.settings.saving = false;
	},

	SAVING_SETTINGS: (state) => {
		state.settings.saving = true;
	},

	UPDATE_MESSAGES: (state, payload) => {
		state.messages = payload;
	},

	UPDATE_DATA: (state, payload) => {
		state.data = payload;
	},
};
