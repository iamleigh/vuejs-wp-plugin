<template>
	<div role="none" class="leighton-quito-field">
		<div v-if="error" class="leighton-quito-notice leighton-quito-notice--error">
			<p>Whoops! Something an error just happened. Check on the console for more info.</p>
		</div>

		<div v-if="!error && loading" class="leighton-quito-notice leighton-quito-notice--loading">
			<p>Loading content...</p>
		</div>

		<div v-if="!error && !loading && type === 'table'">
			<h3>{{ tableData.title }}</h3>
			<lq-table
				:unix="JSON.parse(formData.timestamp)"
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
import List from './List.vue';
import { mapGetters, mapActions } from 'vuex';

export default {
	components: {
		'lq-table': Table,
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
				return this.table;
			}
		},
		chartData: {
			get() {
				return this.chart;
			}
		}
	},
	methods: {
		...mapActions([ 'FETCH_SETTINGS' ]),
		fetchSettings: function () {
			this.FETCH_SETTINGS();
		},
		getAwesomeData: async function () {
			await axios
				.get('https://miusage.com/v1/challenge/2/static/')
				.then((res) => {
					this.chart = res.data.graph;
					this.table = res.data.table;
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
