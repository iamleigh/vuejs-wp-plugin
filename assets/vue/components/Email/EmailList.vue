<template>
	<div ref="emailListWrapper">
		<transition-group
			tag="ul"
			v-if="GET_TOTAL_EMAIL_LIST > 0">
			<li
				v-for="email in GET_EMAIL_LIST"
				:key="email.id">
				<EmailPreview :email-item="email" />
			</li>
		</transition-group>
		<div v-else>
			<p>There are no emails</p>
		</div>
	</div>
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
	},
	mounted () {
		this.scrollToBottom();
	},
	methods: {
		scrollToBottom: function () {
			this.$nextTick(() => {
				const element = this.$refs.emailListWrapper;
				element.scrollTop = element.scrollHeight;
			});
		}
	}
}
</script>
