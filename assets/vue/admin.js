import Vue from "vue";
import Vuex from "vuex";
import Router from "vue-router";
import store from "../store/index";
import App from "./App.vue";
import TabNavigation from "./components/tabs/Navigation.vue";
import TableTab from "./components/tabs/TableTab.vue";
import GraphTab from "./components/tabs/GraphTab.vue";
import SettingsTab from "./components/tabs/SettingsTab.vue";
import VueRouter from "vue-router";

Vue.use(Vuex);
Vue.use(Router);

const routes = [
	{
		path: "/",
		components: { default: TableTab, tab: TabNavigation },
	},
	{
		path: "/graph",
		components: { default: GraphTab, tab: TabNavigation },
	},
	{
		path: "/settings",
		components: { default: SettingsTab, tab: TabNavigation },
	},
];

const router = new VueRouter({
	routes,
});

new Vue({
	el: "#lq-admin-app",
	store,
	router,
	render: (h) => h(App),
});
