<template>
	<div
		v-if="hasTitle || hasLeftContent || hasRightContent"
		class="leighton-quito-settings-row">
		<div class="leighton-quito-settings-row__group">
			<div
				v-if="hasTitle || hasLeftContent"
				role="presentation"
				class="leighton-quito-settings-row__left">
				<div v-if="hasTitle" class="leighton-quito-settings-row__title">{{ title }}</div>
				<slot name="left" />
			</div>

			<div
				v-if="hasRightContent"
				class="leighton-quito-settings-row__right">
				<slot name="right" />
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: 'UIRow',
	props: {
		title: {
			Type: String,
			default: null
		},
	},
	computed: {
		hasLeftContent: function () {
			return !!this.$slots.left;
		},
		hasRightContent: function () {
			return !!this.$slots.right;
		},
		hasTitle: function () {
			const title = this.title;

			if ( title !== null && title !== '' ) {
				return true;
			}

			return false;
		}
	}
}
</script>
