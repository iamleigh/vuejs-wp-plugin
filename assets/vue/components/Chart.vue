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
				return [
					'1686585914',
					'1686672314',
					'1686758714',
					'1686845114',
					'1686931514',
					'1687017914',
					'1687104314'
				];
			}
		},
		data: {
			Type: Array,
			default () {
				return [
					8113,
					9072,
					8651,
					1470,
					17910,
					6252,
					36302
				];
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
