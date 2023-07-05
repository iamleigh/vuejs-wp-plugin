<template>
	<div
		id="leighton-quito-tab-graph"
		class="leighton-quito-tabs__content"
		aria-labelledby="leighton-quito-graph">
		<h2>Graph Tab</h2>

		<lq-data type="chart" />
	</div>
</template>

<script>
import DataDisplay from '../components/DataDisplay.vue';

export default {
	name: 'GraphTab',
	components: {
		'lq-data': DataDisplay
	}
}
</script>
