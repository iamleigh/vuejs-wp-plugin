<template>
	<ul>
		<li
			v-for="(email, index) in emails"
			v-bind:key="`lq-email-${index++}`">
			{{ email.value }}
		</li>
	</ul>
</template>

<script>
export default {
	name: 'EmailList',
	props: {
		emails: {
			Type: Array,
			default: {}
		}
	}
}
</script>
