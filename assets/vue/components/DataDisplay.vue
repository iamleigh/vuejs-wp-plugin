<template>
	<div role="none" class="leighton-quito-field">
		<div v-if="error" class="leighton-quito-notice leighton-quito-notice--error">
			<p>Whoops! Something just happened. Check on the console for more info.</p>
		</div>

		<div v-if="!error && loading" class="leighton-quito-notice leighton-quito-notice--loading">
			<p>Loading content</p>
		</div>

		<div v-if="!error && !loading && type === 'table'">
			<h3>{{ tableData.title }}</h3>
			<lq-table
				:unix="JSON.parse(formData.timestamp)"
				:limit="JSON.parse(formData.tablerows)"
				:headers="tableData.data.headers"
				:rows="tableData.data.rows" />
		</div>

		<div v-if="!error && !loading && type === 'chart'">
			<lq-chart
				:unix="JSON.parse(formData.timestamp)"
				:labels="pushAwesomeData('labels')"
				:data="pushAwesomeData('values')" />
		</div>

		<div v-if="!error && !loading && type === 'list'">
			<h3>Allowed Emails</h3>
			<lq-list :items="formData.emails" />
		</div>
	</div>
</template>

<script>
import Vue from 'vue';
import axios from 'axios';
import Table from './Table.vue';
import Chart from './Chart.vue';
import List from './List.vue';
import { mapGetters, mapActions } from 'vuex';

export default {
	name: 'DataDisplay',
	components: {
		'lq-table': Table,
		'lq-chart': Chart,
		'lq-list': List
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
