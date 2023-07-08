<template>
	<div
		role="none"
		class="leighton-quito-field"
		:class="setFieldClass">
		<label v-if="label" class="leighton-quito-field__label">
			{{ label }}
		</label>

		<div
			role="none"
			class="leighton-quito-field__content"
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

			if (this.status.loading) {
				setClass += 'leighton-quito-field--loading';
			} else if (this.status.error) {
				setClass += 'leighton-quito-field--error';
			}

			return setClass;
		}
	}
}
</script>
