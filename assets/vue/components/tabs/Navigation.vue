<template>
	<ul class="lq-tabs__menu">
		<li><router-link to="/">Table</router-link></li>
		<li><router-link to="/graph">Graph</router-link></li>
		<li><router-link to="/settings">Settings</router-link></li>
	</ul>
</template>

<script>
export default {
	name: 'TabNavigation'
}
</script>
