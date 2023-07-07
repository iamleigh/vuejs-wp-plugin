<template>
	<Bar
		id="leighton-quito-chart"
		:options="chartOptions"
		:data="chartData" />
</template>

<script>
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, BarElement, CategoryScale, LinearScale } from 'chart.js';

ChartJS.register(
	Title,
	Tooltip,
	BarElement,
	CategoryScale,
	LinearScale
);

export default {
	name: 'UIChart',
	components: {
		Bar
	},
	props: {
		labels: {
			Type: Array,
			default () {
				return [];
			}
		},
		data: {
			Type: Array,
			default () {
				return [];
			}
		},
		unix: {
			Type: Boolean,
			default: true
		}
	},
	data () {
		return {
			chartData: {
				labels: this.unix ? this.labels : this.convertLabels(),
				datasets: [{
					data: this.data,
					backgroundColor: '#809EB0',
					borderColor: '#395360'
				}]
			},
			chartOptions: {
				responsive: true
			}
		}
	},
	mounted () {
		this.convertLabels(),
		this.convertDate()
	},
	methods: {
		convertLabels() {
			const data = this.labels;
			const labels = [];

			for (const item in data) {
				labels.push(this.convertDate(data[item]));
			}

			return labels;
		},
		convertDate( timestamp, time = false ) {
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
		},
	}
}
</script>
