<template>
	<label class="leighton-quito-radio">
		<input
			type="radio"
			v-bind="$attrs"
			:checked="isChecked"
			:value="value"
			@change="$emit('change', $event.target.value)"/>
		<slot></slot>
	</label>
</template>

<script>
export default {
	name: 'UIRadio',
	inheritAttrs: false,
	model: {
		prop: 'modelValue',
		event: 'change'
	},
	props: {
		value: {
			Type: String,
			default: null
		},
		modelValue: {
			default: ''
		}
	},
	computed: {
		isChecked: function () {
			return this.modelValue === this.value;
		}
	}
}
</script>
