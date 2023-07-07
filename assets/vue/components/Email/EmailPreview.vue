<template>
	<div>
		<span>{{ emailItem.value }}</span>
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

export default {
	name: 'EmailPreview',
	components: {
		UIButton
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
