<template>
	<div
		id="leighton-quito-tab-table"
		class="leighton-quito-tabs__content"
		aria-labelledby="leighton-quito-table">
		<h2>Table Tab</h2>

		<list
			:headers="headers"
			:rows="rows" />
	</div>
</template>

<script>
export default {
	name: 'TableTab',
	data () {
		return {
			headers: [
				'ID', 'Url', 'Title', 'Pageviews', 'Date'
			],
			rows: [
				{
					"id": 60,
					"url": "http://www.test.com/9939/",
					"title": "Awesome Page 5124",
					"pageviews": 3963,
					"date": 1688190121
				},
				{
					"id": 4,
					"url": "http://www.test.com/2384/",
					"title": "Awesome Page 4027",
					"pageviews": 815,
					"date": 1688103721
				},
				{
					"id": 3,
					"url": "http://www.test.com/8889/",
					"title": "Awesome Page 6204",
					"pageviews": 3058,
					"date": 1687758121
				},
				{
					"id": 27,
					"url": "http://www.test.com/1542/",
					"title": "Awesome Page 2883",
					"pageviews": 7894,
					"date": 1688190121
				},
				{
					"id": 77,
					"url": "http://www.test.com/2209/",
					"title": "Awesome Page 3501",
					"pageviews": 4097,
					"date": 1687844521
				}
			]
		}
	},
	mounted () {},
	computed: {},
	methods: {}
}
</script>
