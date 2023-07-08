<template>
	<div
		id="leighton-quito-tab-table"
		class="leighton-quito-tabs__content"
		aria-labelledby="leighton-quito-table">
		<h2>{{ msgData.tableTitle }}</h2>

		<DataPreview type="table" />

		<DataPreview type="list" />
	</div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import DataPreview from '../components/Data/DataPreview.vue';

export default {
	name: 'TabTable',
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
				return this.GET_MESSAGES;
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
