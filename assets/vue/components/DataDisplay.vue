<template>
	<div role="none" class="leighton-quito-field">
		<UINotice v-if="error" mode="error">
			<p>Whoops! Something just happened. Check on the console for more info.</p>
		</UINotice>

		<UINotice v-else-if="loading" mode="loading">
			<p>Loading content</p>
		</UINotice>

		<DataBlock
			v-else
			:title="setBlockTitle">
			<lq-table
				v-if="'table' === type"
				:unix="JSON.parse(formData.timestamp)"
				:limit="JSON.parse(formData.tablerows)"
				:headers="tableData.data.headers"
				:rows="tableData.data.rows" />

			<UIChart
				v-else-if="'chart' === type"
				:unix="JSON.parse(formData.timestamp)"
				:labels="pushAwesomeData('labels')"
				:data="pushAwesomeData('values')" />

			<EmailList
				v-else-if="'list' === type"
				:emails="formData.emails" />
		</DataBlock>
	</div>
</template>

<script>
import Vue from 'vue';
import axios from 'axios';
import UINotice from './UI/UINotice.vue';
import UIChart from './UI/UIChart.vue';
import DataBlock from './Data/DataBlock.vue';
import Table from './Table.vue';
import EmailList from './Email/EmailList.vue';
import { mapGetters, mapActions } from 'vuex';

export default {
	name: 'DataDisplay',
	components: {
		'lq-table': Table,
		UIChart,
		EmailList,
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
		this.getAwesomeData(),
		this.pushAwesomeData()
	},
	computed: {
		...mapGetters([ 'GET_GENERAL_SETTINGS' ]),
		formData: {
			get() {
				return this.GET_GENERAL_SETTINGS
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
				return 'Allowed Emails';
			}

			return;
		}
	},
	methods: {
		...mapActions([ 'FETCH_SETTINGS' ]),
		fetchSettings: function () {
			this.FETCH_SETTINGS();
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
