<template>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">Navbar w/ text</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarText">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Features</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Pricing</a>
	      </li>
	    </ul>
	    <div class="collapse navbar-collapse" id="navbarSupported">
	    	<ul class="navbar-nav ml-auto">
	    		<template v-if="currentUser">
	    			<li>
						<router-link to="/customers" class="nav-link">Customers</router-link>
						<router-link to="/excel" class="nav-link">Excel</router-link>
					</li>
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false" aria-haspopup=true>
							{{ currentUser.name }} <span class="caret"></span>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a href="#" @click.prevent="logout()" class="dropdown-item">Logout</a>
							
						</div>
					</li>
	    		</template>
	    		<template v-else>
					<li>
	    				<router-link to="/login" class="nav-link">Login</router-link>
	    				<router-link to="/register" class="nav-link">Register</router-link>
	    			</li>
	    		</template>
	    	</ul>
	    </div>
	  </div>
	</nav>
</template>
<script>
	export default{
		data(){
			return{

			}
		},
		methods: {
			logout(){
				this.$store.commit('logout');
				this.$router.push('/login');
			}
		},
		computed: {
			currentUser(){
				return this.$store.getters.currentUser;
			}
		}
	}
</script>