<template>
	<UIField
		error="Invalid email"
		:status="status">
		<UIInput
			type="email"
			placeholder="New email"
			v-model="emailNew.value"
			@keyup.enter="createEmailNew()" />

		<UIButton
			type="button"
			buttonDesign="secondary"
			buttonIcon="plus"
			@button-click="createEmailNew()">
			Add Email
		</UIButton>
	</UIField>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import UIField from '../UI/UIField.vue';
import UIButton from '../UI/UIButton.vue';
import UIInput from '../UI/UIInput.vue';

export default {
	name: 'EmailNew',
	components: {
		UIField,
		UIButton,
		UIInput
	},
	data () {
		return {
			emailNew: {
				value: ''
			},
			status: {
				error: false,
				loading: false
			}
		}
	},
	computed: {
		...mapGetters(['GET_EMAIL_LAST']),
		createEmailId: function () {
			if ('undefined' !== typeof this.GET_EMAIL_LAST) {
				return parseInt(this.GET_EMAIL_LAST.id) + 1;
			}

			return 1;
		},
		createEmailValue: function () {
			return this.emailNew.value.trim();
		}
	},
	methods: {
		...mapActions(['ADD_EMAIL']),
		cleanEmailNew: function () {
			this.emailNew.value = '';
		},
		createEmailNew: function () {
			const emailId = this.createEmailId;
			const emailValue = this.createEmailValue;

			const email = {
				id: emailId,
				value: emailValue
			}

			// Enable loading state
			this.status.loading = true;

			// Validate email
			if (!/^[^@]+@\w+(\.\w+)+\w$/.test(email.value)) {
				// Disable loading state
				this.status.loading = false;

				// Enable error state
				this.status.error = true;
				return;
			}

			// Disable error state
			this.status.error = false;

			// Disable loading state
			this.status.loading = false;

			// Perform add email action
			this.ADD_EMAIL(email);

			this.cleanEmailNew();
			this.emitAddEmail();
		},
		emitAddEmail: function () {
			this.$emit('add-email');
		}
	}
}
</script>
