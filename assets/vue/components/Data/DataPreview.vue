<template>
	<div role="none" class="leighton-quito-field">
		<UINotice v-if="error" mode="error">
			<p>Whoops! Something just happened. Check on the console for more info.</p>
		</UINotice>

		<UINotice v-else-if="loading" mode="loading">
			<p>Loading data...</p>
		</UINotice>

		<DataBlock
			v-else
			:title="setBlockTitle">
			<UITable
				v-if="'table' === type"
				:unix="formData.timestamp"
				:limit="formData.tablerows"
				:headers="tableData.data.headers"
				:rows="tableData.data.rows" />

			<UIChart
				v-else-if="'chart' === type"
				:unix="formData.timestamp"
				:labels="pushAwesomeData('labels')"
				:data="pushAwesomeData('values')" />

			<EmailDisplay
				v-else-if="'list' === type"
				:emails="formData.emails" />
		</DataBlock>
	</div>
</template>

<script>
import Vue from 'vue';
import axios from 'axios';
import { mapGetters, mapActions } from 'vuex';
import DataBlock from './DataBlock.vue';
import EmailDisplay from '../Email/EmailDisplay.vue';
import UINotice from '../UI/UINotice.vue';
import UIChart from '../UI/UIChart.vue';
import UITable from '../UI/UITable.vue';

export default {
	name: 'DataPreview',
	components: {
		UINotice,
		UIChart,
		UITable,
		EmailDisplay,
		DataBlock
	},
	props: {
		type: {
			Type: String,
			default: 'chart'
		},
		isProduction: {
			Type: Boolean,
			default: !Vue.config.devtools
		}
	},
	data () {
		return {
			chart: {},
			table: {},
			loading: true,
			error: false
		}
	},
	mounted () {
		this.fetchSettings(),
		this.fetchMessages(),
		this.getAwesomeData(),
		this.pushAwesomeData()
	},
	computed: {
		...mapGetters([ 'GET_GENERAL_SETTINGS', 'GET_MESSAGES' ]),
		formData: {
			get() {
				return this.GET_GENERAL_SETTINGS;
			}
		},
		msgData: {
			get() {
				return this.GET_MESSAGES;
			}
		},
		tableData: {
			get() {
				return JSON.parse(this.table);
			}
		},
		chartData: {
			get() {
				return JSON.parse(this.chart);
			}
		},
		setBlockTitle: function () {
			if ('table' === this.type) {
				return this.tableData.title;
			} else if ('list' === this.type) {
				return this.msgData.emailsTitle;
			}

			return;
		}
	},
	methods: {
		...mapActions([ 'FETCH_SETTINGS', 'FETCH_MESSAGES' ]),
		fetchSettings: function () {
			this.FETCH_SETTINGS();
		},
		fetchMessages: function () {
			this.FETCH_MESSAGES();
		},
		getAwesomeData: async function () {
			const lqCachedChart = localStorage.getItem('lqCachedChart');
			const lqCachedTable = localStorage.getItem('lqCachedTable');
			const lqCachedStamp = localStorage.getItem('lqCachedStamp');

			if (lqCachedChart && lqCachedTable && lqCachedStamp) {
				const oneHour = 60 * 60 * 1000; // 1 hour in milliseconds
				const currentTime = new Date().getTime();
				const isDataValid = currentTime - lqCachedStamp < oneHour;

				if (isDataValid) {
					// Remove the loading state
					this.loading = false;

					// Use the cached data
					this.chart = lqCachedChart;
					this.table = lqCachedTable;

					return;
				}
			}

			// Make the API call
			await axios
				.get('https://miusage.com/v1/challenge/2/static/')
				.then((res) => {
					// Cache the response and timestamp
					localStorage.setItem('lqCachedChart', JSON.stringify(res.data.graph));
					localStorage.setItem('lqCachedTable', JSON.stringify(res.data.table));
					localStorage.setItem('lqCachedStamp', new Date().getTime());

					// Use the fetched data
					this.chart = JSON.stringify(res.data.graph);
					this.table = JSON.stringify(res.data.table);
				})
				.catch((err) => {
					console.log(err);
					this.error = true;
				})
				.finally(() => {
					this.loading = false;
				});
		},
		pushAwesomeData: function ( type ) {
			const data = this.chartData;
			const labels = [];
			const values = [];

			if (Object.keys(data).length > 0) {
				for (const item in data) {
					labels.push(data[item].date);
					// labels.push(this.human_date(data[item].date))
					values.push(data[item].value);
				}
			}

			return 'labels' === type ? labels : values;
		}
	}
}
</script>
