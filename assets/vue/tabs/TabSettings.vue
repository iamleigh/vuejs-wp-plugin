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

			<UISection title="Rows">
				<template v-slot:right>
					<UIField
						label="Limit the number of rows to display at the table."
						helper="The allowed rows value must be between 1 and 5.">
						<UIInput
							type="number"
							min="1"
							max="5"
							required
							v-model="formData.tablerows" />
					</UIField>
				</template>
			</UISection>

			<UISection title="Timestamp">
				<template v-slot:right>
					<UIField role="radiogroup">
						<UIRadio name="timestamp" value="true" v-model="formData.timestamp">
							Unix Time
						</UIRadio>

						<UIRadio name="timestamp" value="false" v-model="formData.timestamp">
							Human Date
						</UIRadio>
					</UIField>
				</template>
			</UISection>

			<UISection title="Emails">
				<template v-slot:right>
					<UIField>
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
					</UIField>

					<EmailNew @add-task="scrollToBottom()" />
				</template>
			</UISection>

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
import UISection from '../components/UI/UISection.vue';
import UIButton from '../components/UI/UIButton.vue';
import UIInput from '../components/UI/UIInput.vue';
import UIRadio from '../components/UI/UIRadio.vue';
import UIField from '../components/UI/UIField.vue';
import EmailNew from '../components/Email/EmailNew.vue';

export default {
	name: 'TabSettings',
	components: {
		UISection,
		UIButton,
		UIInput,
		UIRadio,
		UIField,
		EmailNew
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
		},
		scrollToBottom: function () {
			this.$refs.taskList.scrollToBottom();
		}
	}
}
</script>
