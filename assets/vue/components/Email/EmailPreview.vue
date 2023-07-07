<template>
	<div>
		<UIInput
			type="email"
			:value="emailItem.value"
			placeholder="Add a new email"
			readonly />

		<UIButton
			type="button"
			buttonIcon="trash"
			buttonDesign="tertiary"
			:disabled="hideRemove"
			@button-click="REMOVE_EMAIL(emailItem.id)">
			Remove Email
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
	computed: {
		...mapGetters([ 'GET_TOTAL_EMAIL_LIST' ]),
		hideRemove: function () {
			if (parseInt(this.GET_TOTAL_EMAIL_LIST) === 1) {
				return true;
			}

			return false;
		}
	},
	methods: {
		...mapActions([ 'REMOVE_EMAIL' ])
	}
}
</script>
