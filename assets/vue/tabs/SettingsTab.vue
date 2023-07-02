<template>
	<div
		id="leighton-quito-tab-settings"
		class="leighton-quito-tabs__content"
		aria-labelledby="leighton-quito-settings">
		<h2>Edit Settings</h2>

		<settings-row>
			<template v-slot:left>
				<label for="lq-table-rows" id="lq-table-rows__label">Rows</label>
			</template>

			<template v-slot:right>
				<div class="leighton-quito-field">
					<span class="leighton-quito-field__label">Limit the number of rows to display in the table.</span>
					<input
						type="number"
						min="1"
						max="5"
						value="5"
						id="lq-table-rows"
						class="small-text"
						aria-labelledby="lq-table-rows__label"
						aria-describedby="lq-table-rows__desc" />
					<span id="lq-table-rows__desc" class="leighton-quito-field__desc">The allowed rows value must be between 1 and 5.</span>
				</div>
			</template>
		</settings-row>

		<settings-row title="Timestamp">
			<template v-slot:right>
				<div role="radiogroup" class="leighton-quito-radio__group">
					<label class="leighton-quito-radio">
						<input type="radio" id="custom" name="timestamp" value="custom">
						Date
					</label>

					<label class="leighton-quito-radio">
						<input type="radio" id="unix" name="timestamp" value="unix">
						Unix
					</label>
				</div>
			</template>
		</settings-row>

		<settings-row title="Emails">
			<template v-slot:right>
				<div class="leighton-quito-field">
					<div class="leighton-quito-field leighton-quito-field--inline">
						<input type="email" value="name@email.com" class="leighton-quito-input leighton-quito-field__item" readonly />
						<action label="Remove email" icon="no-alt" design="secondary" />
					</div>
				</div>

				<div class="leighton-quito-field">
					<span class="leighton-quito-field__label">Add an email address</span>
					<div
						role="none"
						class="leighton-quito-field leighton-quito-field--inline">
						<input type="email" class="leighton-quito-input leighton-quito-field__item" />
						<action label="Add Email" />
					</div>
				</div>
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
