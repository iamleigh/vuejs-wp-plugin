<template>
	<div
		id="leighton-quito-tab-table"
		class="leighton-quito-tabs__content"
		aria-labelledby="leighton-quito-table">
		<h2>Table Tab</h2>

		<lq-data type="table" />

		<lq-data type="list" />
	</div>
</template>

<script>
import DataDisplay from '../components/DataDisplay.vue';

export default {
	name: 'TableTab',
	components: {
		'lq-data': DataDisplay
	}
}
</script>
