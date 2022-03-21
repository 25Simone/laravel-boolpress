<template>
    <div>
        <!-- Navbar -->
        <the-navbar class="bg-dark navbar-dark"></the-navbar>
        <!-- Main -->
        <main class="container py-4">
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
// Components
import TheNavbar from "../components/TheNavbar.vue";

export default {
    components: {
      TheNavbar,
    },
}
</script>

<style lang="scss" scoped>
</style>