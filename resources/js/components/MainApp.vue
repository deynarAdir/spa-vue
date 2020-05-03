<template>
    <div id="main">
        <navbar></navbar>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Navbar from './shared/Navbar.vue';
    export default {
        name: 'main-app',
        components: {
            Navbar
        },
        mounted() {
            console.log('Component mounted.');
        }
    }
</script>
