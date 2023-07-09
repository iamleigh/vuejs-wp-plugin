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
		state.saving = false;
	},

	SAVING_SETTINGS: (state) => {
		state.saving = true;
	},

	UPDATE_MESSAGES: (state, payload) => {
		state.messages = payload;
	},
};
