<template>
	<div class="container">
		<h1>hola desde home</h1>
		<h2>{{ welcomes }}</h2>
	</div>
</template>
<script>
	export default{
		name: 'home',
		computed: {
			welcomes(){
				return this.$store.getters.welcome;
			}
		}
	}
</script>