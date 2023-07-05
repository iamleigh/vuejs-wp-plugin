import Vue from 'vue';
import Vuex from 'vuex';
import store from '../store/index';
// import Router from 'vue-router';
import VueRouter from 'vue-router';
import App from './App.vue';
import Navigation from './tabs/Navigation.vue';
import TableTab from './tabs/TableTab.vue';
import GraphTab from './tabs/GraphTab.vue';
import SettingsTab from './tabs/SettingsTab.vue';
import Button from './components/Button.vue';
import SettingsRow from './components/SettingsRow.vue';
import FormField from './components/FormField.vue';

Vue.use(Vuex);
Vue.use(VueRouter);

const routes = [
	{
		path: '/',
		components: { default: TableTab, tab: Navigation },
	},
	{
		path: '/graph',
		components: { default: GraphTab, tab: Navigation },
	},
	{
		path: '/settings',
		components: { default: SettingsTab, tab: Navigation },
	},
];

// Register router
const router = new VueRouter({
	routes,
});

// Register components
Vue.component('lq-button', Button);
Vue.component('lq-field', FormField);
Vue.component('lq-settings', SettingsRow);

new Vue({
	el: '#lq-admin-app',
	store,
	router,
	render: (h) => h(App),
});
