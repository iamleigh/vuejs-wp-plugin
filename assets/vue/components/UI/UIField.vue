<template>
	<div
		role="none"
		class="leighton-quito-field"
		:class="setFieldClass"
		:disabled="status.loading">
		<label v-if="label" class="leighton-quito-field__label">
			{{ label }}
		</label>

		<div
			:role="'radiogroup' === role ? 'radiogroup' : 'none'"
			:class="setContentClass"
			v-bind="$attrs">
			<slot />
		</div>

		<span
			v-if="status.error && error"
			class="leighton-quito-field__error">
			{{ error }}
		</span>

		<span
			v-if="helper"
			class="leighton-quito-field__helper">
			{{ helper }}
		</span>
	</div>
</template>

<script>
export default {
	name: 'UIField',
	inheritAttrs: false,
	props: {
		required: {
			Type: Boolean,
			default: false
		},
		role: {
			Type: String,
			default: false
		},
		label: {
			Type: String,
			default: null
		},
		helper: {
			Type: String,
			default: null
		},
		error: {
			Type: String,
			default: null
		},
		status: {
			Type: Object,
			default: () => ({
				error: false,
				loading: false
			})
		}
	},
	computed: {
		hasLabel: function () {
			return this.label ? true : false;
		},
		hasHelper: function () {
			return this.helper ? true : false;
		},
		setFieldClass: function () {
			let setClass = '';

			if (this.required) {
				setClass += 'form-required';

				if (this.status.error) {
					setClass += ' form-invalid';
				}

				if (this.status.loading) {
					setClass += ' ';
				}
			}

			if (this.status.loading) {
				setClass += 'leighton-quito-field--loading';
			}

			return setClass;
		},
		setContentClass: function () {
			let setClass = '';

			if ('radiogroup' === this.role) {
				setClass += 'leighton-quito-field__radiogroup';
			} else if ('emailgroup' === this.role) {
				setClass += 'leighton-quito-email-list__item';
			} else {
				setClass += 'leighton-quito-field__content';
			}

			return setClass;
		}
	}
}
</script>
