<template>
	<transition-group
		v-if="GET_TOTAL_EMAIL_LIST > 0"
		tag="div"
		role="list"
		class="leighton-quito-email-list"
		ref="emailListWrapper">
		<EmailPreview
			v-for="email in GET_EMAIL_LIST"
			:key="email.id"
			role="listitem"
			:email-item="email"
			class="leighton-quito-email-list__item" />
	</transition-group>
</template>

<script>
import { mapGetters } from 'vuex';
import EmailPreview from './EmailPreview.vue';

export default {
	name: 'EmailList',
	components: {
		EmailPreview
	},
	computed: {
		...mapGetters([
			'GET_EMAIL_LIST',
			'GET_TOTAL_EMAIL_LIST'
		])
	}
}
</script>
