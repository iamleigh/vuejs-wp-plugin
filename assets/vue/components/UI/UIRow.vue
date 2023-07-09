<template>
	<div
		v-if="hasTitle || hasLeftContent || hasRightContent"
		role="none"
		class="leighton-quito-row">
		<div
			v-if="hasTitle || hasLeftContent"
			role="presentation"
			class="leighton-quito-row__left">
			<component
				v-if="hasTitle"
				:is="checkTitleTag"
				class="leighton-quito-row__title">
				{{ checkTitleValue }}
			</component>
			<slot name="left" />
		</div>

		<div
			v-if="hasRightContent"
			role="presentation"
			class="leighton-quito-row__right">
			<slot name="right" />
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
		heading: {
			Type: String,
			default: null
		},
		label: {
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
			if ( this.title || this.label || this.heading ) {
				return true;
			}

			return false;
		},
		checkTitleTag: function () {
			if (this.label) {
				return 'label';
			} else if (this.heading) {
				return 'h3';
			}

			return 'span';
		},
		checkTitleValue: function () {
			if (this.label) {
				return this.label;
			} else if (this.heading) {
				return this.heading;
			}

			return this.title;
		}
	}
}
</script>
