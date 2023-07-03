<template>
	<div>
		<Bar
			id="leighton-quito-chart"
			:options="chartOptions"
			:data="chartData" />
	</div>
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
			Type: Object,
			default () {
				return {};
			}
		}
	},
	data () {
		return {
			chartData: {
				labels: this.labels,
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
	}
}
</script>
