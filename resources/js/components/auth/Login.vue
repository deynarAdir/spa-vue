<template>
	<div class="row">
		<div class="col-md-6 col-md-offset-6">
			<div class="card">
				<div class="card-header">
					Login
				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="" class="form-control">Email:</label>
						<input type="email" class="form-control" v-model="user.email">
					</div>
					<div class="form-group">
						<label for="" class="form-control">Password:</label>
						<input type="email" class="form-control" v-model="user.password">
					</div>
					<div class="form-group text-center">
						<button class="button" @click="authenticate()">Ingresar</button>
					</div>
					<div class="form-group" v-if="authErrors">
						<p class="text-danger"> 
							{{ authErrors }}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		name: 'login',
		data(){
			return {
				user: {
					email: '',
					password: ''
				},
				errors: null
			}
		},
		methods: {
			authenticate(){
				let mi = this;
				this.$store.dispatch('login');
				axios({
					method:'post',
					url: 'api/auth/login',
					data: {
						email: this.user.email,
						password: this.user.password
					}
				})
				.then(function (response) {
					console.log(response);
					mi.$store.commit('loginSuccess',response.data);
					mi.$router.push({path: '/'});
				}).catch(function (error) {
					console.log(error);
					mi.$store.commit('loginFailed', error);
				});
			}
		},
		computed: {
			authErrors(){
				return this.$store.getters.authError;
			}
		}
	}
</script>