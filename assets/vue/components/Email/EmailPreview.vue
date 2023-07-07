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
			@button-click="REMOVE_EMAIL(emailItem.id)">
			Remove Email
		</UIButton>
	</div>
</template>

<script>
import { mapActions } from 'vuex';
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
	methods: {
		...mapActions([ 'REMOVE_EMAIL' ])
	}
}
</script>
