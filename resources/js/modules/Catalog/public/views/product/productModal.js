import axios from 'axios';
import store from "../../../../../profile/store";
import Vue from 'vue';
import ProductPopup from './components/Popup.vue';

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

Vue.prototype.$http=axios;
new Vue({
    el: '#category-product-list',
    delimiters: ["<%", "%>"],
    components: {
        ProductPopup
    },
    data() {
        return {
            productid: null,
            activemodal: true
        }
    }
});
