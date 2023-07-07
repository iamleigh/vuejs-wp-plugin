<template>
	<div>
		<UIInput
			type="email"
			placeholder="New Email"
			v-model="emailNew.value"
			@keyup.enter="createEmailNew()" />

		<UIButton
			type="button"
			buttonDesign="secondary"
			buttonIcon="plus"
			@button-click="createEmailNew()">
			Add Email
		</UIButton>
	</div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import UIButton from '../UI/UIButton.vue';
import UIInput from '../UI/UIInput.vue';

export default {
	name: 'EmailNew',
	components: {
		UIButton,
		UIInput
	},
	data () {
		return {
			emailNew: {
				value: ''
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

			if ('' !== emailValue) {
				this.ADD_EMAIL(email);
			}

			this.cleanEmailNew();
			this.emitAddEmail();
		},
		emitAddEmail: function () {
			this.$emit('add-email');
		}
	}
}
</script>
