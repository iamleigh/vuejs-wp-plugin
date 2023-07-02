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
				<div role="radiogroup" class="leighton-quito-radio__group">
					<div class="leighton-quito-radio">
						<input type="radio" id="unix" name="timestamp" value="unix">
						<label>Unix</label>
					</div>

					<div class="leighton-quito-radio">
						<input type="radio" id="custom" name="timestamp" value="custom">
						<label>Custom</label>
					</div>
				</div>
			</template>
		</settings-row>

		<settings-row title="Emails">
			<template v-slot:right>
				<div class="">
					<div class="">
						<input type="email" value="name@email.com" readonly />
						<button class="leighton-quito-icon-button">X</button>
					</div>
				</div>

				<div class="">
					<label class="">Add an email address</label>
					<input type="email" />
					<button class="leighton-quito-button">Add Email</button>
				</div>
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
