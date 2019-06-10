import axios from 'axios';
import Vue from 'vue';
import store from './store';
import settings from "../settings";
import VeeValidate from 'vee-validate';
import BootstrapVue from 'bootstrap-vue';
import ToggleButton from 'vue-js-toggle-button';

import router from "./routes";
import {moduleRoutes} from './moduleRoutes';

import Admin from "./Admin";
import Default from "./layouts/Default";
import Blank from "./layouts/Blank";
import Echo from 'laravel-echo';
import io from 'socket.io-client';

import titleComponent from './components/PageTitle';
import StateIco from './components/parts/StateIco';
import TableLabel from './components/parts/TableLabel';
import LanguageSwitcher from './components/parts/LanguageSwitcher';
import ToggleSwitch from './components/parts/ToggleSwitch';
import ContainerXl from './components/parts/ContainerXl';
import MainTitle from './components/parts/MainTitle';
import FormFooter from './components/parts/FormFooter';
import FormInputUnit from './components/parts/FormInputUnit';
import CategoryList from './components/parts/CategoryList';

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

// vee-validate zlobi s b-table - oboje definuje fields jako computed property a pak to hazi chyby do konzole
const veeValidateConfig = {
	fieldsBagName: 'inputs ', //Default is fields
};

Vue.use (VeeValidate, veeValidateConfig);
Vue.use (BootstrapVue);
Vue.use (ToggleButton);

Vue.component ('default-layout', Default);
Vue.component ('blank-layout', Blank);
Vue.component ('vue-title', titleComponent);
Vue.component ('state-ico', StateIco);
Vue.component ('table-label', TableLabel);
Vue.component ('language-switcher', LanguageSwitcher);
Vue.component ('toggle-switch', ToggleSwitch);
Vue.component ('container-xl', ContainerXl);
Vue.component ('main-title', MainTitle);
Vue.component ('form-footer', FormFooter);
Vue.component ('form-input-unit', FormInputUnit);
Vue.component ('category-list', CategoryList);

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

window.io = io;

let authToken = store.getters.getAuthToken;
window.Echo = new Echo ({
	auth: {
		headers: {
			Authorization: `Bearer ${authToken}`
		}
	},
	broadcaster: 'socket.io',
	host: window.location.hostname + ':' + settings.WS_PORT
});

new Vue ({
	el: "#app",
	router,
	store,
	render: h => h (Admin)
});

