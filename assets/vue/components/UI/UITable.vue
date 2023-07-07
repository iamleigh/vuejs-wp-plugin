<template>
	<table class="wp-list-table widefat fixed striped table-view-list pages">
		<thead v-if="hasHeaders">
			<tr>
				<th
					v-for="item in headers"
					scope="col"
					:id="`page-${item.toLowerCase()}`"
					:class="item.toLowerCase() === 'id' ? 'column-posts' : ''">{{ item }}</th>
			</tr>
		</thead>

		<tbody v-if="hasRows">
			<tr v-for="(item, index) in rows.slice(0, limit)" v-bind:key="`row-${index}--${item.id}`">
				<td>{{ item.id }}</td>
				<td>
					<a :href="item.url" target="_blank" rel="nofollow noreferrer">
						{{ item.url }}
					</a>
				</td>
				<td>
					<strong>{{ item.title }}</strong>
				</td>
				<td>{{ item.pageviews }}</td>
				<td>{{ unix ? item.date : humanDate(item.date) }}</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
export default {
	name: 'UITable',
	props: {
		headers: {
			Type: Array,
			default () {
				return [];
			}
		},
		rows: {
			Type: Object,
			default () {
				return {};
			}
		},
		unix: {
			Type: Boolean,
			default: true
		},
		limit: {
			Type: Number,
			default: null,
			required: true
		}
	},
	computed: {
		hasHeaders: function () {
			const headers = this.headers;

			if (headers.length > 0) {
				return true;
			}

			return false;
		},
		hasRows: function () {
			const rows = this.rows;

			if (rows.length > 0) {
				return true;
			}

			return false;
		},
	},
	methods: {
		humanDate(timestamp) {
			const date = new Date(timestamp * 1000);

			const day = ('0' + date.getDate()).slice(-2);
			const month = ('0' + date.getMonth()).slice(-2);
			const year = date.getFullYear();
			const buildDate = `${year}/${month}/${day}`;

			const hours = ('0' + date.getHours()).slice(-2);
			const minutes = ('0' + date.getMinutes()).slice(-2);
			const seconds = ('0' + date.getSeconds()).slice(-2);
			const buildTime = `${hours}:${minutes}:${seconds}`;

			const formatted = `${buildDate} at ${buildTime}`;

			return formatted;
		}
	}
}
</script>
