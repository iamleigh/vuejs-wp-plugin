<template>
	<div
		id="leighton-quito-tab-settings"
		class="leighton-quito-tabs__content"
		aria-labelledby="leighton-quito-settings">
		<h2>Edit Settings</h2>

		<settings-row title="Rows">
			<template v-slot:right>
				<field
					label="Limit the number of rows to display at the table."
					helper="The allowed rows value must be between 1 and 5.">
					<input
						type="number"
						min="1"
						max="5"
						value="5"
						id="lq-table-rows"
						class="small-text" />
				</field>
			</template>
		</settings-row>

		<settings-row title="Timestamp">
			<template v-slot:right>
				<field isRadioGroup="true">
					<label class="leighton-quito-radio">
						<input type="radio" id="unix" name="timestamp" value="unix">
						Unix Time
					</label>

					<label class="leighton-quito-radio">
						<input type="radio" id="human-date" name="timestamp" value="human">
						Human Date
					</label>
				</field>
			</template>
		</settings-row>

		<settings-row title="Emails">
			<template v-slot:right>
				<field>
					<input type="email" value="name@email.com" class="leighton-quito-input leighton-quito-field__item" readonly />
					<action label="Remove email" icon="no-alt" design="secondary" />
				</field>

				<field label="Add an email address">
					<input type="email" class="leighton-quito-input leighton-quito-field__item" />
					<action label="Add Email" />
				</field>
			</template>
		</settings-row>

		<button class="leighton-quito-button leighton-quito-button--primary leighton-quito-button--orange">
			Save Settings
		</button>
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
