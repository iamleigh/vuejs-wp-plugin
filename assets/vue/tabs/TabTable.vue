<template>
	<div
		id="leighton-quito-tab-table"
		class="leighton-quito-tabs__content"
		aria-labelledby="leighton-quito-table">
		<h2>Table Tab</h2>

		<DataPreview type="table" />

		<DataPreview type="list" />
	</div>
</template>

<script>
import DataPreview from '../components/Data/DataPreview.vue';

export default {
	name: 'TabTable',
	components: {
		DataPreview
	}
}
</script>
