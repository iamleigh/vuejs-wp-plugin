<template>
	<div role="tablist" class="leighton-quito-tabs__menu">
		<router-link
			v-for="tab in tabsList"
			v-bind:key="tab.id"
			:to={path:tab.router}
			role="tab"
			class="leighton-quito-tabs__item"
			activeClass="active"
			ariaCurrentValue="true">
			{{ tab.name }}
		</router-link>
	</div>
</template>

<script>
export default {
	name: 'TabNavigation',
	data () {
		return {
			tabsList: [
				{name: 'Table', router: '/', id: 1},
				{name: 'Graph', router: '/graph', id: 2},
				{name: 'Settings', router: '/settings', id: 3}
			]
		}
	}
}
</script>
