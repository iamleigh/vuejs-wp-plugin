<template>
	<div>
		<UIInput
			type="email"
			:value="emailItem.value"
			readonly />

		<UIButton
			type="button"
			buttonIcon="trash"
			buttonDesign="tertiary"
			:disabled="hideRemove"
			@button-click="REMOVE_EMAIL(emailItem.id)">
			{{ msgData.buttonRemove }}
		</UIButton>
	</div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import UIButton from '../UI/UIButton';
import UIInput from '../UI/UIInput.vue';

export default {
	name: 'EmailPreview',
	components: {
		UIButton,
		UIInput
	},
	props: {
		emailItem: {
			Type: Object,
			required: true
		}
	},
	mounted () {
		this.fetchMessages()
	},
	computed: {
		...mapGetters([ 'GET_MESSAGES', 'GET_TOTAL_EMAIL_LIST' ]),
		msgData: {
			get () {
				return this.GET_MESSAGES;
			}
		},
		hideRemove: function () {
			if (parseInt(this.GET_TOTAL_EMAIL_LIST) === 1) {
				return true;
			}

			return false;
		}
	},
	methods: {
		...mapActions([ 'FETCH_MESSAGES', 'REMOVE_EMAIL' ]),
		fetchMessages: function () {
			this.FETCH_MESSAGES();
		}
	}
}
</script>
