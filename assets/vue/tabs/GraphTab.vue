<template>
	<div
		id="leighton-quito-tab-graph"
		class="leighton-quito-tabs__content"
		aria-labelledby="leighton-quito-graph">
		<h2>Graph Tab</h2>

		<chart
			:labels="pushData('labels')"
			:data="pushData('values')" />
	</div>
</template>

<script>
export default {
	name: 'GraphTab',
	data () {
		return {
			data: []
		}
	},
	async mounted () {
		this.getData(),
		this.pushData()
	},
	computed: {},
	methods: {
		async getData() {
			const cachedGraphData = localStorage.getItem('cachedGraphData');
			const cachedGraphTimestamp = localStorage.getItem('cachedGraphTimestamp');

			if (cachedGraphData && cachedGraphTimestamp) {
				const oneHour = 60 * 60 * 1000; // 1 hour in milliseconds
				const currentTime = new Date().getTime();
				const isDataValid = currentTime - cachedGraphTimestamp < oneHour;

				if (isDataValid) {
					// Use the cached data
					this.data = JSON.parse(cachedGraphData);
					return;
				}
			}

			// Make the API call
			const response = await fetch('https://miusage.com/v1/challenge/2/static/');
			const data = await response.json();

			// Cache the response and timestamp
			localStorage.setItem('cachedGraphData', JSON.stringify(data.graph));
			localStorage.setItem('cachedGraphTimestamp', new Date().getTime());

			// Use the fetched data
			this.data = data.graph;
		},
		pushData( type ) {
			const data = JSON.parse(localStorage.getItem('cachedGraphData'));
			const labels = [];
			const values = [];

			if (Object.keys(data).length > 0) {
				for (const item in data) {
					// labels.push(data[item].date);
					labels.push(this.human_date(data[item].date))
					values.push(data[item].value);
				}
			}

			return type === 'values' ? values : labels;
		},
		human_date( timestamp, time = false ) {
			const date = new Date(timestamp * 1000);
			const months = [
				'January',
				'February',
				'March',
				'April',
				'May',
				'June',
				'July',
				'August',
				'September',
				'October',
				'November',
				'December',
			];

			const day = date.getDate();
			const month = time ? months[date.getMonth()].slice(0, 3) : months[date.getMonth()];
			const year = date.getFullYear();
			const buildDate = `${month} ${day}, ${year}`;

			const hours = ('0' + date.getHours()).slice(-2);
			const minutes = ('0' + date.getMinutes()).slice(-2);
			const seconds = ('0' + date.getSeconds()).slice(-2);
			const buildTime = `${hours}:${minutes}:${seconds}`;

			const formatted = `${buildDate}${time ? ` @ ${buildTime}` : ''}`;

			return formatted;
		}
	}
}
</script>
