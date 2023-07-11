<template>
	<UISection :title="setBlockTitle">
		<DataBlock>
			<UITable
				v-if="('table' === type && 'undefined' !== typeof getData.table)"
				:unix="formData.timestamp"
				:limit="formData.tablerows"
				:headers="getData.table.data.headers"
				:rows="getData.table.data.rows" />

			<UIChart
				v-else-if="('chart' === type && 'undefined' !== typeof getData.graph)"
				:unix="formData.timestamp"
				:labels="pushAwesomeData('labels')"
				:data="pushAwesomeData('values')" />

			<EmailDisplay
				v-else-if="'list' === type"
				:emails="formData.emails" />
		</DataBlock>
	</UISection>
</template>

<script>
import Vue from 'vue';
import { mapGetters, mapActions } from 'vuex';
import UISection from '../UI/UISection.vue';
import UINotice from '../UI/UINotice.vue';
import UIChart from '../UI/UIChart.vue';
import UITable from '../UI/UITable.vue';
import DataBlock from './DataBlock.vue';
import EmailDisplay from '../Email/EmailDisplay.vue';

export default {
	name: 'DataPreview',
	components: {
		UISection,
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
	mounted () {
		this.fetchSettings(),
		this.fetchMessages(),
		this.fetchData(),
		this.pushAwesomeData()
	},
	computed: {
		...mapGetters([ 'GET_GENERAL_SETTINGS', 'GET_MESSAGES', 'GET_DATA' ]),
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
		getData: {
			get() {
				return this.GET_DATA;
			}
		},
		setBlockTitle: function () {
			if ('table' === this.type) {
				if ('undefined' !== typeof this.getData.table) {
					return this.getData.table.title;
				}
			} else if ('list' === this.type) {
				return this.msgData.emailsTitle;
			}

			return '';
		}
	},
	methods: {
		...mapActions([ 'FETCH_SETTINGS', 'FETCH_MESSAGES', 'FETCH_DATA' ]),
		fetchSettings: function () {
			this.FETCH_SETTINGS();
		},
		fetchMessages: function () {
			this.FETCH_MESSAGES();
		},
		fetchData: function () {
			this.FETCH_DATA();
		},
		pushAwesomeData: function ( type ) {
			const data = this.getData.graph;
			const labels = [];
			const values = [];

			if ('undefined' !== typeof data) {
				if (Object.keys(data).length > 0) {
					for (const item in data) {
						labels.push(data[item].date);
						values.push(data[item].value);
					}
				}
			}

			return 'labels' === type ? labels : values;
		}
	}
}
</script>
