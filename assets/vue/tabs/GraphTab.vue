<template>
	<div
		id="leighton-quito-tab-graph"
		class="leighton-quito-tabs__content"
		aria-labelledby="leighton-quito-graph">
		<h2>Graph Tab</h2>

		<DataPreview type="chart" />
	</div>
</template>

<script>
import DataPreview from '../components/Data/DataPreview.vue';

export default {
	name: 'GraphTab',
	components: {
		DataPreview
	}
}
</script>
