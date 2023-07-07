<template>
	<ul class="leighton-quito-list">
		<li
			v-for="(item, index) in items"
			v-bind:key="`email-${index}`"
			class="leighton-quito-list__item">
			{{ item.value }}
		</li>
	</ul>
</template>

<script>
export default {
	props: {
		items: {
			Type: Object,
			default: []
		}
	}
}
</script>
