import { getLocalUser } from './helpers/auth.js'

const user = getLocalUser();

export default {
	state: {
		currentUser: user,
		isLoggedIn: user,
		loading: false,
		auth_error: null,
		customers: []
	},
	getters: {
		isLoading(state){
			return state.loading; 
		},
		isLoggedIn(state){
			return state.isLoggedIn; 
		},
		authError(state){
			return state.auth_error; 
		},
		customers(state){
			return state.customers; 
		},
		currentUser(state){
			return state.currentUser;
		}
	},
	mutations: {
		login(state){
			state.loading = true;
			state.auth_error = null;
		},
		loginSuccess(state, account){
			state.auth_error = null;
			state.isLoggedIn = true;
			state.loading = false;
			state.currentUser = Object.assign({}, account.user, {token: account.access_token});

			localStorage.setItem("user",JSON.stringify(state.currentUser));
		},
		loginFailed(state, errors){
			state.loading = false;
			state.auth_error = errors;
		},
		logout(state){
			localStorage.removeItem("user");
			state.isLoggedIn = false;
			state.currentUser = null;
		},
		setCustomers(state, data){
			state.customers = data;
		}
	},
	actions: {
		login(context){
			context.commit('login');
		}
	}
}