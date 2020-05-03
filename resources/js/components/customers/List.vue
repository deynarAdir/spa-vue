<template>
	<div>
		<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
		  <input type="text" class="form-control" :placeholder="searchParameter?'introduzca '+searchParameter:'introduzca'" v-model="word" @keyup.enter="search()">
		  <div class="btn-group d-inline" role="group">
		    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		      Buscar por...
		    </button>
		    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
		      <a class="dropdown-item" href="#" @click="searchParameter='name'">Name</a>
		      <a class="dropdown-item" href="#" @click="searchParameter='email'">Email</a>
		      <a class="dropdown-item" href="#" @click="searchParameter='phone'">Phone</a>
		    </div>
		  </div>
		</div>
		<button class="btn btn-outline-dark" @click="search()">Buscar</button>
		<div class="text-right mb-3 d-inline">
			<router-link to="/customers/new" class="btn btn-success btn-sm float-right">New</router-link>
		</div><br><br>
		<table class="table">
			<thead>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Actions</th>
			</thead>
			<tbody>
				<template v-if="customers.length > 0">
					<tr v-for="customer in customers" :key="customer.id">
						<td>{{ customer.name }}</td>
						<td>{{ customer.email }}</td>
						<td>{{ customer.phone }}</td>
						<td>
							<router-link :to="`/customers/${customer.id}`" class="btn btn-outline-info btn-sm">Detalles</router-link>
						</td>
					</tr>
				</template>
				<template v-else>
					<tr>
						<td colspan="4" class="text-center">No hay registros</td>
					</tr>
				</template>
			</tbody>
		</table>
		<pagination :pagination="pagination" :offset="3" @paginations="changeFunction($event)" v-if="pagination"></pagination>
	</div>
</template>
<script>
	import Pagination from './../Pagination.vue';
	export default {
		components: {
			Pagination
		},
		name: 'list',
		data(){
			return {
				pagination: null,
				searchParameter: null,
				word: ''
			}
		},
		mounted(){
			this.getCustommers();
		},
		computed: {
			customers(){
				return this.$store.getters.customers;
			}
		},
		methods: {
			changeFunction(page){
				if(this.word != '' || this.word != null){
					this.search(page);
				}else{
					this.getCustommers(page);
				}
			},
			getCustommers(page = 1){
				let mi = this;
				axios({
					method:'get',
					headers: {
						'Authorization': `Bearer ${this.$store.getters.currentUser.token}`
					},
					url: 'api/customers?page='+page
				})
				.then(function (response) {
					console.log(response);
					mi.$store.commit('setCustomers',response.data.customers.data);
					mi.pagination = response.data.pagination;
				}).catch(function (error) {
					console.log(error);
				});
			},
			search(page=1){
				if(this.searchParameter==null){
					return;
				}
				let mi = this;
				axios({
					method:'get',
					headers: {
						'Authorization': `Bearer ${this.$store.getters.currentUser.token}`
					},
					url: 'api/search/customers?page='+page,
					params: {
						column: this.searchParameter,
						word: this.word
					}
				})
				.then(function (response) {
					console.log(response);
					mi.$store.commit('setCustomers',response.data.customers.data);
					mi.pagination = response.data.pagination;
				}).catch(function (error) {
					console.log(error);
				});
			}
		}
	}
</script>