<template>
	<div
		id="leighton-quito-tab-graph"
		class="leighton-quito-tabs__content"
		aria-labelledby="leighton-quito-graph">
		<h2>{{ msgData.graphTitle }}</h2>

		<DataPreview type="chart" />
	</div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import DataPreview from '../components/Data/DataPreview.vue';

export default {
	name: 'TabGraph',
	components: {
		DataPreview
	},
	mounted () {
		this.fetchMessages()
	},
	computed: {
		...mapGetters([ 'GET_MESSAGES' ]),
		msgData: {
			get() {
				return this.GET_MESSAGES
			}
		},
	},
	methods: {
		...mapActions([ 'FETCH_MESSAGES' ]),
		fetchMessages: function () {
			this.FETCH_MESSAGES();
		}
	}
}
</script>
