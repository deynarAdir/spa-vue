<template>
	<div v-if="customer">
		<div class="form-group">
			<label for="">ID:</label>
			<p>{{ customer.id }}</p>
		</div>
		<div class="form-group">
			<label for="">Name:</label>
			<p>{{ customer.name }}</p>
		</div>
		<div class="form-group">
			<label for="">Email:</label>
			<p>{{ customer.email }}</p>
		</div>
		<div class="form-group">
			<label for="">Phone:</label>
			<p>{{ customer.phone }}</p>
		</div>
		<div class="form-group">
			<label for="">Website:</label>
			<p>{{ customer.website }}</p>
		</div>
		<div>
			<div class="text-left">
				<router-link class="btn btn-outline-info" to="/customers">Atras</router-link>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		name: 'show',
		data(){
			return {
				customer: null
			}
		},
		created(){
			if(this.customers.length){
				this.customer = this.customers.find((customer)=> customer.id == this.$route.params.id);
			}else{
				let mi = this;
				axios({
					method:'get',
					headers: {
						'Authorization': `Bearer ${this.$store.getters.currentUser.token}`
					},
					url: `/api/customers/${this.$route.params.id}`
				})
				.then(function (response) {
					console.log(response);
					mi.customer = response.data.customer;
				}).catch(function (error) {
					console.log(error);
				});
			}
		},
		computed: {
			customers(){
				return this.$store.getters.customers;
			}
		}
	}
</script>