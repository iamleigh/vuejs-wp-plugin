<template>
	<Content id="settings" :title="msgData.settingsTitle">
		<form
			id="leighton-quito-settings-form"
			:class="`leighton-quito-form${isSaving ? ' leighton-quito--disabled' : ''}`"
			:disabled="isSaving"
			@submit="saveSettings">

			<UISection :title="msgData.rowsTitle">
				<template v-slot:right>
					<UIField
						:label="msgData.rowsLabel"
						:helper="msgData.rowsHelper">
						<UIInput
							type="number"
							min="1"
							max="5"
							required
							v-model="formData.tablerows" />
					</UIField>
				</template>
			</UISection>

			<UISection :title="msgData.timeTitle">
				<template v-slot:right>
					<UIField role="radiogroup">
						<UIRadio name="timestamp" value="true" v-model="formData.timestamp">
							{{ msgData.timeUnix }}
						</UIRadio>

						<UIRadio name="timestamp" value="false" v-model="formData.timestamp">
							{{ msgData.timeDate }}
						</UIRadio>
					</UIField>
				</template>
			</UISection>

			<UISection :title="msgData.emailsTitle">
				<template v-slot:right>
					<EmailList ref="emailList" />
					<EmailNew
						v-if="!hideEmail"
						@add-task="scrollToBottom()" />
				</template>
			</UISection>

			<UIButton
				type="submit"
				buttonDesign="primary"
				:buttonLoading="isSaving"
				:disabled="isSaving">
				{{ msgData.buttonSave }}
			</UIButton>

		</form>
	</Content>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import Content from './Content.vue';
import UISection from '../components/UI/UISection.vue';
import UIButton from '../components/UI/UIButton.vue';
import UIInput from '../components/UI/UIInput.vue';
import UIRadio from '../components/UI/UIRadio.vue';
import UIField from '../components/UI/UIField.vue';
import EmailList from '../components/Email/EmailList.vue';
import EmailNew from '../components/Email/EmailNew.vue';

export default {
	name: 'TabSettings',
	components: {
		Content,
		UISection,
		UIButton,
		UIInput,
		UIRadio,
		UIField,
		EmailList,
		EmailNew
	},
	data () {
		return {}
	},
	mounted () {
		this.fetchMessages(),
		this.fetchSettings()
	},
	computed: {
		...mapGetters([
			'GET_MESSAGES',
			'GET_GENERAL_SETTINGS',
			'GET_TOTAL_EMAIL_LIST',
			'GET_SAVING_STATE'
		]),
		formData: {
			get() {
				return this.GET_GENERAL_SETTINGS;
			}
		},
		msgData: {
			get() {
				return this.GET_MESSAGES;
			}
		},
		isSaving: {
			get() {
				return this.GET_SAVING_STATE;
			}
		},
		hideEmail: function () {
			if (parseInt(this.GET_TOTAL_EMAIL_LIST) === 5) {
				return true;
			}

			return false;
		}
	},
	methods: {
		...mapActions([ 'FETCH_MESSAGES', 'FETCH_SETTINGS', 'SAVE_SETTINGS' ]),
		fetchMessages: function () {
			this.FETCH_MESSAGES();
		},
		fetchSettings: function () {
			this.FETCH_SETTINGS();
		},
		saveSettings: function (e) {
			this.SAVE_SETTINGS( this.formData );
			e.preventDefault();
		},
		scrollToBottom: function () {
			this.$refs.taskList.scrollToBottom();
		}
	}
}
</script>
