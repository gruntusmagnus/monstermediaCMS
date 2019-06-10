import Vue from 'vue'
import VueRouter from 'vue-router';

import EmployeeList from './views/Employee/List.vue';
import EmployeeCreate from './views/Employee/Create.vue';
import Customer from './views/Customer.vue';
import LoginForm from './views/LoginForm';
import ResetPasswordForm from "./views/ResetPasswordForm";
import ForgottenPassword from "./views/ForgottenPassword";

Vue.use (VueRouter);

export default new VueRouter ({
	mode: 'history',
	base: '/admin/',
	routes: [
		{
			path: '/login',
			component: LoginForm,
			name: "Login",
			meta: {
				layout: 'blank-layout',
				public: true
			}
		},
		{
			path: '/password-reset',
			component: ForgottenPassword,
			name: "ResetPassword",
			meta: {
				layout: 'blank-layout',
				public: true
			}
		},
		{
			path: '/reset-password/:token',
			name: 'reset-password-form',
			component: ResetPasswordForm,
			meta: {
				layout: 'blank-layout',
				public: true
			}
		},
		{
			path: '/employee',
			name: 'Employee',
			component: EmployeeList
		},
		{
			path: '/employee/create',
			name: 'EmployeeCreate',
			component: EmployeeCreate
		},
		{
			path: '/customer',
			component: Customer
		}
	]
});