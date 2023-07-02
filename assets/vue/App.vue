<template>
	<div class="leighton-quito-tabs">
		<router-view name="tab"></router-view>
		<router-view></router-view>
	</div>
</template>

<script>
import TabNavigation from './tabs/Navigation.vue'

export default {
    name: 'App',
	components: {
		'tab-navigation': TabNavigation
	}
}
</script>
