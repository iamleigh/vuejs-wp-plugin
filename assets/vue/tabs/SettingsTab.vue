<template>
	<div
		id="leighton-quito-tab-settings"
		class="leighton-quito-tabs__content"
		aria-labelledby="leighton-quito-settings">
		<h2>Edit Settings</h2>

		<form
			id="leighton-quito-settings-form"
			:class="`leighton-quito-form${isSaving ? ' leighton-quito--disabled' : ''}`"
			:disabled="isSaving"
			@submit="saveSettings">

			<lq-settings title="Rows">
				<template v-slot:right>
					<lq-field
						label="Limit the number of rows to display at the table."
						helper="The allowed rows value must be between 1 and 5.">
						<UIInput
							type="number"
							min="1"
							max="5"
							required
							v-model="formData.tablerows" />
					</lq-field>
				</template>
			</lq-settings>

			<lq-settings title="Timestamp">
				<template v-slot:right>
					<lq-field isRadioGroup="true">
						<UIRadio name="timestamp" value="true" v-model="formData.timestamp">
							Unix Time
						</UIRadio>

						<UIRadio name="timestamp" value="false" v-model="formData.timestamp">
							Human Date
						</UIRadio>
					</lq-field>
				</template>
			</lq-settings>

			<lq-settings title="Emails">
				<template v-slot:right>
					<lq-field>
						<div v-for="(email, index) in formData.emails" v-bind:key="`allowed-email-${index}`">
							<UIInput
								type="email"
								:value="email.value"
								placeholder="Add a new email"
								readonly />

							<UIButton
								type="button"
								buttonIcon="no-alt"
								buttonDesign="secondary">
								Remove Email
							</UIButton>
						</div>
					</lq-field>

					<lq-field label="Add an email address">
						<UIInput type="email" placeholder="Add a new email" />

						<UIButton
							type="button"
							buttonDesign="primary">
							Add Email
						</UIButton>
					</lq-field>
				</template>
			</lq-settings>

			<UIButton
				type="submit"
				buttonDesign="primary"
				:buttonLoading="isSaving"
				:disabled="isSaving">
				{{ buttonLabel }}
			</UIButton>

		</form>
	</div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import UIButton from '../components/UI/UIButton.vue';
import UIInput from '../components/UI/UIInput.vue';
import UIRadio from '../components/UI/UIRadio.vue';

export default {
	name: 'SettingsTab',
	components: {
		UIButton,
		UIInput,
		UIRadio
	},
	data () {
		return {}
	},
	mounted () {
		this.fetchSettings()
	},
	computed: {
		...mapGetters([ 'GET_GENERAL_SETTINGS', 'GET_BUTTON_LABEL', 'GET_SAVING_STATE' ]),
		formData: {
			get() {
				return this.GET_GENERAL_SETTINGS;
			}
		},
		buttonLabel: {
			get() {
				return this.GET_BUTTON_LABEL;
			}
		},
		isSaving: {
			get() {
				return this.GET_SAVING_STATE;
			}
		}
	},
	methods: {
		...mapActions([ 'FETCH_SETTINGS', 'SAVE_SETTINGS' ]),
		saveSettings: function (e) {
			this.SAVE_SETTINGS( this.formData );
			e.preventDefault();
		},
		fetchSettings: function () {
			this.FETCH_SETTINGS();
		}
	}
}
</script>
