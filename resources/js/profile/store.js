import Vue from 'vue'
import Vuex from 'vuex'
import axios from "axios";

import settings from "../settings";

Vue.use (Vuex);

export default new Vuex.Store ({
	state: {
		authorization_token: null,
		user: null,
	},
	mutations: {
		saveToken: (state, token) => {
			state.authorization_token = token;

			localStorage.token = token;
		},
		saveUserInfo: (state, info) => {
			state.user = info;
		},
		logout: (state) => {
			state.authorization_token = null;
			delete localStorage.customerAuthorizationToken;
		},
	},

	getters: {
		getAuthToken: (state) => {
			if (state.authorization_token === null) {
				state.authorization_token = localStorage.getItem ('customerAuthorizationToken');
			}

			return state.authorization_token;
		},
		isLoggedIn: (state, getters) => {
			return getters.getAuthToken !== null
		},

	},

	actions: {
		loadUserInfo: ({commit, getters, dispatch}) => {
			if (!getters.isLoggedIn)
				return;

			return axios.get (settings.API_URL + "me").then ((response) => {
				commit ('saveUserInfo', response.data);
			}).catch (() => {
				// error occured, fire logout
				commit ('logout');
				commit ('saveUserInfo', {});
			})
		}
	}
})
