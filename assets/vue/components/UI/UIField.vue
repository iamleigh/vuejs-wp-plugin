<template>
	<div
		role="none"
		class="leighton-quito-field"
		:class="hasError ? 'leighton-quito-field--error' : ''">
		<label v-if="label" class="leighton-quito-field__label">
			{{ label }}
		</label>

		<div
			class="leighton-quito-field__content"
			v-bind="$attrs">
			<slot />
		</div>

		<span
			v-if="hasError && errorMessage"
			class="leighton-quito-field__error">
			{{ errorMessage }}
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
		errorMessage: {
			Type: String,
			default: null
		},
		hasError: {
			Type: Boolean,
			default: false
		}
	},
	computed: {
		hasLabel: function () {
			return this.label ? true : false;
		},
		hasHelper: function () {
			return this.helper ? true : false;
		}
	}
}
</script>
