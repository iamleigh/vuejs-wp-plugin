<template>
	<div
		role="tabpanel"
		:id="`leighton-quito-tab-${id}`"
		class="leighton-quito-tabs__content"
		:aria-labelledby="`leighton-quito-${id}`">
		<div role="none" class="leighton-quito-body">
			<h2 v-if="hasTitle" class="leighton-quito-body__title">{{ title }}</h2>
			<slot />
		</div>
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
