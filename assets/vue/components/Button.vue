<template>
	<button :type="type" :class="setClass">
		<span v-if="hasIcon" :class="setIconClass" aria-hidden="true"></span>
		<span v-if="hasIcon" class="screen-reader-text">{{ label }}</span>
		<span v-if="!hasIcon" role="none" class="leighton-quito-button__label">{{ label }}</span>
	</button>
</template>

<script>
export default {
	props: {
		label: {
			Type: String,
			default: null,
			required: true
		},
		icon: {
			Type: String,
			default: null
		},
		design: {
			Type: String,
			default: 'primary'
		},
		type: {
			Type: String,
			default: 'button'
		},
		loading: {
			Type: Boolean,
			default: false
		}
	},
	computed: {
		hasIcon: function () {
			const icon = this.icon;

			if (null !== icon && '' !== icon) {
				return true;
			}

			return false;
		},
		setClass: function () {
			const icon = this.icon;
			const design = this.design;

			let setClass = 'leighton-quito-button';

			if (null !== icon && '' !== icon) {
				setClass += ' leighton-quito-button--icon';
			}

			switch (design) {
				case 'primary':
				case 'secondary':
					setClass += ' leighton-quito-button--' + design;
					break;

				default:
					throw new Error(
						`The only available values for the "design" property on the button component are "primary" and "secondary".`
					);
					break;
			}

			return setClass;
		},
		setIconClass: function () {
			const icon = this.icon;

			let setClass = 'leighton-quito-button__icon dashicons';

			if (null !== icon && '' !== icon) {
				setClass += ' dashicons-' + icon;
			}

			return setClass;
		}
	}
}
</script>
