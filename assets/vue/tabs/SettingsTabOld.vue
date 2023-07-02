<template>
	<div id="lq-settings-tab" class="lq-tabs">
		<h2>Settings</h2>

		<form id="" @submit="saveSettings">
			<table>
				<tbody>
					<tr>
						<th scope="row">
							<label for="rowsnumber">Rows</label>
						</th>
						<td>
							<input type="text" id="rowsnumber" class="regular-text" v-model="formData.rowsnumber">
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label>Timestamp Format</label>
						</th>
						<td>
							<input type="radio" id="unix" name="timestamp" value="unix">
							<input type="radio" id="custom" name="timestamp" value="custom">
						</td>
					</tr>
				</tbody>
			</table>
			<p class="submit">
				<button type="submit" class="button button-primary">{{ loadingText }}</button>
			</p>
		</form>
	</div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
	name: 'SettingsTab',
	data () {
		return {}
	},
	mounted () {
		this.fetchSettings()
	},
	computed: {
		...mapGetters([ 'GET_SETTINGS', 'GET_LOADING_TEXT' ]),

		formData: {
			get() {
				return this.GET_GENERAL_SETTINGS
			}
		},

		loadingText: {
			get() {
				return this.GET_LOADING_TEXT
			}
		}
	},
	methods: {
		...mapActions([ 'FETCH_SETTINGS', 'SAVE_SETTINGS'  ]),

		saveSettings(e) {
			e.preventDefault();
			this.SAVE_SETTINGS( this.formData )
		},

		fetchSettings() {
			this.FETCH_SETTINGS
		}
	}
}
</script>
