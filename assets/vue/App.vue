<template>
	<fragment>
		<router-view name="tab"></router-view>
		<router-view></router-view>
	</fragment>
</template>

<script>
import { Fragment } from 'vue-fragment';
import TabNavigation from './components/tabs/Navigation.vue'

export default {
    name: 'App',
	components: {
		Fragment,
		'tab-navigation': TabNavigation
	}
}
</script>
