<template>
	<component
		:is="checkTag"
		:href="buttonHref"
		:to="buttonTo"
		:value="buttonValue"
		class="leighton-quito-button"
		:class="setButtonClass"
		@click="buttonClick">
		<UIIcon v-if="hasButtonIcon" :name="buttonIcon" />
		<span :class="setLabelClass" role="none">
			<slot />
		</span>
	</component>
</template>

<script>
import UIIcon from './UIIcon.vue';

export default {
	name: 'UIButton',
	components: {
		UIIcon
	},
	props: {
		buttonHref: {
			Type: String,
			default: null
		},
		buttonTo: {
			Type: String,
			default: null
		},
		buttonValue: {
			Type: String,
			default: null
		},
		buttonIcon: {
			Type: String,
			default: null
		},
		buttonDesign: {
			Type: String,
			default: 'primary'
		},
		buttonLoading: {
			Type: Boolean,
			default: false
		}
	},
	computed: {
		checkTag: function () {
			if (this.href) {
				return 'a';
			} else if (this.value) {
				return 'input';
			} else if (this.to) {
				return 'router-link';
			}

			return 'button';
		},
		hasButtonIcon: function () {
			const icon = this.buttonIcon;

			if (this.icon) {
				return true;
			}

			return false;
		},
		setButtonClass: function () {
			let setClass = '';

			if (this.buttonIcon) {
				setClass += 'leighton-quito-button--icon ';
			}

			switch (this.buttonDesign) {
				case 'primary':
				case 'secondary':
					setClass += 'leighton-quito-button--' + this.buttonDesign;
					break;

				default:
					throw new Error(
						`The only available "design" values for the UIButton component are "primary" and "secondary".`
					);
					break;
			}

			if (this.buttonLoading) {
				setClass += ' loading';
			}

			return setClass;
		},
		setLabelClass: function () {
			if (this.hasButtonIcon) {
				return 'screen-reader-text';
			}

			return 'leighton-quito-button__label';
		}
	},
	methods: {
		buttonClick: function (event) {
			this.$emit('button-click', event);
		}
	}
}
</script>
