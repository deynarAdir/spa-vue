<template>
	<nav aria-label="Page navigation example">
	  <ul class="pagination">
	    <li class="page-item" v-if="pagination.current_page > 1"><a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">Previous</a></li>
	    <li class="page-item" v-for="page in numberPages" :key="page" :class="page == isActivate?'active':''"><a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a></li>
	    <li class="page-item" v-if="pagination.current_page < pagination.last_page"><a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">Next</a></li>
	  </ul>
	</nav>
</template>
<script>
	export default {
		props: {
			pagination: Object,
			offset: Number
		},
		computed: {
			isActivate(){
				return this.pagination.current_page;
			},
			numberPages(){
				if(!this.pagination.to){
					return [];
				}

				var from = this.pagination.current_page - this.offset;
				if(from < 1){
					from = 1;
				}
				var to = from + (this.offset * 2);
				if(to >= this.pagination.last_page){
					to = this.pagination.last_page;
				}

				var arrayPaginas = [];
				while(from <= to){
					arrayPaginas.push(from);
					from++;
				}
				return arrayPaginas;
			}
		},
		methods: {
			changePage(page){
				this.pagination.current_page = page;
				this.$emit('paginations',page);
			}
		}
	}
</script>