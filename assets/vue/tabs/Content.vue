<template>
	<div
		role="tabpanel"
		:id="`leighton-quito-tab-${id}`"
		class="leighton-quito-tabs__content"
		:aria-labelledby="`leighton-quito-${id}`">
		<h2 v-if="hasTitle">{{ title }}</h2>
		<slot />
	</div>
</template>

<script>
export default {
	name: 'Content',
	props: {
		id: {
			Type: String,
			default: null,
			required: true
		},
		title: {
			Type: String,
			default: null
		}
	},
	computed: {
		hasTitle: function () {
			if (this.title) {
				return true;
			}

			return false;
		}
	}
}
</script>
