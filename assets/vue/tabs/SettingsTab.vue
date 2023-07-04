<template>
	<div
		id="leighton-quito-tab-settings"
		class="leighton-quito-tabs__content"
		aria-labelledby="leighton-quito-settings">
		<h2>Edit Settings</h2>

		<form id="leighton-quito-settings-form">

			<lq-settings title="Rows">
				<template v-slot:right>
					<lq-field
						label="Limit the number of rows to display at the table."
						helper="The allowed rows value must be between 1 and 5.">
						<input
							type="number"
							min="1"
							max="5"
							id="lq-table-rows"
							class="small-text" />
					</lq-field>
				</template>
			</lq-settings>

			<lq-settings title="Timestamp">
				<template v-slot:right>
					<lq-field isRadioGroup="true">
						<label class="leighton-quito-radio">
							<input type="radio" id="unix" name="timestamp" value="unix">
							Unix Time
						</label>

						<label class="leighton-quito-radio">
							<input type="radio" id="human-date" name="timestamp" value="human">
							Human Date
						</label>
					</lq-field>
				</template>
			</lq-settings>

			<lq-settings title="Emails">
				<template v-slot:right>
					<lq-field>
						<input type="email" value="name@email.com" class="leighton-quito-input leighton-quito-field__item" readonly />
						<lq-button label="Remove email" icon="no-alt" design="secondary" />
					</lq-field>

					<lq-field label="Add an email address">
						<input type="email" class="leighton-quito-input leighton-quito-field__item" />
						<lq-button label="Add Email" />
					</lq-field>
				</template>
			</lq-settings>

			<lq-button type="submit" label="Save Settings" design="primary" />

		</form>
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
