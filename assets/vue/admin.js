import Vue from 'vue';
import Vuex from 'vuex';
import Router from 'vue-router';
import store from '../store/index';
import App from './App.vue';
import TabNavigation from './tabs/Navigation.vue';
import TableTab from './tabs/TableTab.vue';
import GraphTab from './tabs/GraphTab.vue';
import SettingsTab from './tabs/SettingsTab.vue';
import VueRouter from 'vue-router';
import Button from './components/Button.vue';
import Chart from './components/Chart.vue';
import SettingsRow from './components/SettingsRow.vue';
import FormField from './components/FormField.vue';

Vue.use(Vuex);
Vue.use(Router);

const routes = [
	{
		path: '/',
		components: { default: TableTab, tab: TabNavigation },
	},
	{
		path: '/graph',
		components: { default: GraphTab, tab: TabNavigation },
	},
	{
		path: '/settings',
		components: { default: SettingsTab, tab: TabNavigation },
	},
];

const router = new VueRouter({
	routes,
});

Vue.component('action', Button);
Vue.component('chart', Chart);
Vue.component('field', FormField);
Vue.component('settings-row', SettingsRow);

new Vue({
	el: '#lq-admin-app',
	store,
	router,
	render: (h) => h(App),
});
