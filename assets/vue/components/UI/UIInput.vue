<template>
	<input
		:value="value"
		class="leighton-quito-input"
		:class="setInputClass"
		@input="$emit('changeValue', $event.target.value)" />
</template>

<script>
export default {
	name: 'UIInput',
	model: {
		prop: 'value',
		event: 'changeValue'
	},
	props: {
		value: {
			Type: String,
			default: ''
		}
	},
	computed: {
		setInputClass: function () {
			if ('radio' === this.type) {
				return 'small-text';
			}

			return;
		}
	}
}
</script>
