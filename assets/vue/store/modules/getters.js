export const getters = {
	GET_GENERAL_SETTINGS: (state) => {
		return state.settings.general;
	},

	GET_EMAIL_LIST: (state) => {
		return state.settings.general.emails;
	},

	GET_TOTAL_EMAIL_LIST: (state) => {
		return state.settings.general.emails.length;
	},

	GET_EMAIL_LAST: (state) => {
		return state.settings.general.emails[
			state.settings.general.emails.length - 1
		];
	},

	GET_SAVING_STATE: (state) => {
		return state.settings.saving;
	},

	GET_MESSAGES: (state) => {
		return state.messages;
	},

	GET_DATA: (state) => {
		return state.data;
	},
};
