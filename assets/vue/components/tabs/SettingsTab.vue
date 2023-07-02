<template>
	<div
		id="leighton-quito-tab-settings"
		class="leighton-quito-tabs__content"
		aria-labelledby="leighton-quito-settings">
		<h2>Edit Settings</h2>

		<settings-row>
			<template v-slot:left>
				<label>Rows</label>
			</template>

			<template v-slot:right>
				<input type="number" min="1" max="5" value="5" />
				<span>Limit the number of rows to display in the table.</span>
			</template>
		</settings-row>

		<settings-row title="Timestamp">
			<template v-slot:right>
				<input type="radio" id="unix" name="timestamp" value="unix">
				<label>Unix</label>

				<input type="radio" id="custom" name="timestamp" value="custom">
				<label>Custom</label>
			</template>
		</settings-row>

		<settings-row>
			<template v-slot:left>
				<label>Emails</label>
			</template>

			<template v-slot:right>
				<input type="email" />
			</template>
		</settings-row>
	</div>
</template>

<script>
export default {
	name: 'SettingsTab',
	data () {
		return {}
	},
	mounted () {},
	computed: {},
	methods: {}
}
</script>
