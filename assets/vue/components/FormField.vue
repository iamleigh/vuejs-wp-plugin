<template>
	<div role="presentation" :class="setClass">
		<label v-if="hasLabel" class="leighton-quito-field__label">{{ label }}</label>
		<div :role="isRadioGroup ? 'radiogroup' : 'none'" class="leighton-quito-field__item">
			<slot></slot>
		</div>
		<span v-if="hasErrorMessage" class="leighton-quito-field__error-message">{{ errorMessage }}</span>
		<span v-if="hasHelper" class="leighton-quito-field__helper">{{ helper }}</span>
	</div>
</template>

<script>
export default {
	props: {
		label: {
			Type: String,
			default: null
		},
		helper: {
			Type: String,
			default: null
		},
		errorMessage: {
			Type: String,
			default: null
		},
		isRadioGroup: {
			Type: Boolean,
			default: false
		}
	},
	computed: {
		hasLabel: function () {
			const label = this.label;

			if (null !== label && '' !== label) {
				return true;
			}

			return false;
		},
		hasHelper: function () {
			const helper = this.helper;

			if (null !== helper && '' !== helper) {
				return true;
			}

			return false;
		},
		hasErrorMessage: function () {
			const errorMessage = this.errorMessage;

			if (null !== errorMessage && '' !== errorMessage) {
				return true;
			}

			return false;
		},
		setClass: function () {
			let setClass = 'leighton-quito-field';

			return setClass;
		}
	}
}
</script>
