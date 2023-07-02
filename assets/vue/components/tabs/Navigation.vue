<template>
	<div role="tablist" class="leighton-quito-tabs__menu">
		<router-link role="tab" class="leighton-quito-tabs__item" ariaCurrentValue="true" to="/">Table</router-link>
		<router-link role="tab" class="leighton-quito-tabs__item" ariaCurrentValue="true" to="/graph">Graph</router-link>
		<router-link role="tab" class="leighton-quito-tabs__item" ariaCurrentValue="true" to="/settings">Settings</router-link>
	</div>
</template>

<script>
export default {
	name: 'TabNavigation'
}
</script>
