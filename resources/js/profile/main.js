import axios from 'axios';
import Vue from 'vue';
import store from './store'
import settings from "../settings"

import BootstrapVue from 'bootstrap-vue';
import router from "./routes"
import {moduleRoutes} from './moduleRoutes';

import App from "./App";
import io from "socket.io-client";
import Echo from "laravel-echo";

// @todo premyslet, kam dat spolecne komponenty - moc jich nebude
import titleComponent from '../admin/components/PageTitle';

Vue.config.productionTip = false;

axios.interceptors.request.use (
	(config) => {
		let token = store.getters.getAuthToken;

		if (token) {
			config.headers['Authorization'] = `Bearer ${token}`;
		}

		return config;
	},

	(error) => {
		return Promise.reject (error);
	}
);


Vue.use (BootstrapVue);

Vue.component('vue-title', titleComponent);

Vue.prototype.$http = axios;
Vue.prototype.API_URL = settings.API_URL;

router.addRoutes (moduleRoutes);
router.beforeEach ((to, from, next) => {
	if (to.matched.some (record => !record.meta.public)) {
		if (!store.getters.isLoggedIn) {
			next ({
				path: '/login',
				query: {redirect: to.fullPath}
			})
		} else {
			next ()
		}
	} else {
		next ()
	}
});

new Vue ({
	el: "#profile",
	router,
	store,
	render: h => h (App)
});


window.io = io;

let authToken = store.getters.getAuthToken;
window.Echo = new Echo ({
	auth: {
		headers: {
			Authorization: `Bearer ${authToken}`
		}
	},
	broadcaster: 'socket.io',
	host: window.location.hostname + ':'+settings.WS_PORT
});