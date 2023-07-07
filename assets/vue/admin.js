import Vue from 'vue';
import Vuex from 'vuex';
import store from '../store/index';
// import Router from 'vue-router';
import VueRouter from 'vue-router';
import App from './App.vue';
import Navigation from './tabs/Navigation.vue';
import TabTable from './tabs/TabTable.vue';
import TabGraph from './tabs/TabGraph.vue';
import TabSettings from './tabs/TabSettings.vue';

Vue.use(Vuex);
Vue.use(VueRouter);

const routes = [
	{
		path: '/',
		components: { default: TabTable, tab: Navigation },
	},
	{
		path: '/graph',
		components: { default: TabGraph, tab: Navigation },
	},
	{
		path: '/settings',
		components: { default: TabSettings, tab: Navigation },
	},
];

// Register router
const router = new VueRouter({
	routes,
});

new Vue({
	el: '#lq-admin-app',
	store,
	router,
	render: (h) => h(App),
});
