<template>
	<Content id="graph" :title="msgData.graphTitle">
		<DataPreview type="chart" />
	</Content>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import Content from './Content.vue';
import DataPreview from '../components/Data/DataPreview.vue';

export default {
	name: 'TabGraph',
	components: {
		Content,
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
