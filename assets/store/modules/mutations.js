export const mutations = {
	UPDATE_SETTINGS: (state, payload) => {
		state.settings.general = payload;
	},
	SAVED_SETTINGS: (state) => {
		state.saving = false;
	},
	SAVING_SETTINGS: (state) => {
		state.saving = true;
	},
};
