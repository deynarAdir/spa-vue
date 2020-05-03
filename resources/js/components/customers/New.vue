<template>
	<div>
		<div class="form-group">
			<label for="">Name:</label>
			<input type="text" class="form-control" :class="$v.customer.name.required && $v.customer.name.minLength? 'is-valid':'is-invalid'" v-model="customer.name" placeholder="Nombre de cliente">
			<div class="invalid-feedback" v-if="!$v.customer.name.required">El campo es obligatorio</div>
			<div class="invalid-feedback" v-if="!$v.customer.name.minLength && $v.customer.name.$dirty">Por lo menos tres caracteres</div>
		</div>
		<div class="form-group">
			<label for="">Email:</label>
			<input type="email" class="form-control" :class="$v.customer.email.$invalid?'is-invalid':'is-valid'" v-model="customer.email" placeholder="Email de cliente">
		</div>
		<div class="form-group">
			<label for="">Phone:</label>
			<input type="text" class="form-control" :class="$v.customer.phone.$invalid?'is-invalid':'is-valid'" v-model="customer.phone" placeholder="Telefono de cliente">
		</div>
		<div class="form-group">
			<label for="">Website:</label>
			<input type="text" class="form-control" :class="$v.customer.website.$invalid?'is-invalid':'is-valid'" v-model="customer.website" placeholder="Website de cliente">
		</div>
		<div>
			<div class="text-left">
				<router-link class="btn btn-outline-info" to="/customers">Atras</router-link>
			</div>
			<div class="text-right">
				<button class="btn btn-outline-success" @click="add()">Crear</button>
			</div>
		</div>
	</div>
</template>
<script>
	import { required, minLength, between, email, url } from 'vuelidate/lib/validators'
	export default {
		name: 'new',
		validations: {
			customer: {
				name: { required, minLength: minLength(3) },
				email: { required,email },
				phone: { required },
				website: { required, url }
			}
		},
		data(){
			return {
				customer: {
					name: '',
					email: '',
					phone: '',
					website: ''
				},
				errors: null
			}
		},
		methods: {
			add(){
				if(this.isInvalid){
					return;
				}
				let mi = this;
				axios({
					method:'post',
					headers: {
						'Authorization': `Bearer ${this.$store.getters.currentUser.token}`
					},
					url: '/api/customers/new',
					data: {
						name: this.customer.name,
						email: this.customer.email,
						phone: this.customer.phone,
						website: this.customer.website
					}
				})
				.then(function (response) {
					console.log(response);
					mi.$router.push('/customers');
				}).catch(function (error) {
					console.log(error);
				});
			}
		},
		computed: {
			isInvalid(){
				if(this.$v.customer.name.$invalid || this.$v.customer.email.$invalid || this.$v.customer.phone.$invalid || this.$v.customer.website.$invalid){
						return true;
				}else{
					return false;
				}
			}
		}
	}
</script>