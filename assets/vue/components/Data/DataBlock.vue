<template>
	<div role="none" class="leighton-quito-data-block">
		<h3 v-if="hasTitle">{{ title }}</h3>
		<slot />
	</div>
</template>

<script>
export default {
	name: 'DataBlock',
	props: {
		title: {
			Type: String,
			default: null
		}
	},
	computed: {
		hasTitle: function () {
			return this.title ? true : false;
		}
	}
}
</script>
