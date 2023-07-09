<template>
	<div role="none" class="leighton-quito-section">
		<h3 v-if="hasTitle" class="leighton-quito-section__title">
			{{ title }}
		</h3>

		<div role="none" class="leighton-quito-section__content">
			<slot />
		</div>
	</div>
</template>

<script>
export default {
	name: 'UISection',
	props: {
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
