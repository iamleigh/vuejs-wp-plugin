export const getters = {
	GET_GENERAL_SETTINGS: (state) => {
		return state.settings.general;
	},

	GET_BUTTON_LABEL: (state) => {
		return state.buttonLabel;
	},

	GET_SAVING_STATE: (state) => {
		return state.saving;
	},
};
