<template>
	<span
		class="dashicons"
		:class="icon"
		aria-hidden="true" />
</template>

<script>
export default {
	name: 'UIIcon',
	props: {
		name: {
			Type: String,
			required: true
		}
	},
	computed: {
		icon: function () {
			return `dashicons-${this.name}`;
		}
	}
}
</script>
