<template>
	<div role="tablist" class="leighton-quito-tabs__menu">
		<router-link
			v-for="tab in tabsList"
			v-bind:key="tab.index"
			:to={path:tab.router}
			role="tab"
			:id="tab.id"
			class="leighton-quito-tabs__item"
			activeClass=""
			exactActiveClass="active"
			:aria-controls="tab.controls"
			ariaCurrentValue="true">
			{{ tab.name }}
		</router-link>
	</div>
</template>

<script>
export default {
	name: 'Navigation',
	data () {
		return {
			tabsList: [
				{index: 1, name: 'Table', router: '/', controls: 'leighton-quito-tab-table', id: 'leighton-quito-table'},
				{index: 2, name: 'Graph', router: '/graph', controls: 'leighton-quito-tab-graph', id: 'leighton-quito-graph'},
				{index: 3, name: 'Settings', router: '/settings', controls: 'leighton-quito-tab-settings', id: 'leighton-quito-settings'}
			]
		}
	}
}
</script>
