<template>
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fs-2" href="/">Laravel Boolpress</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-bs-controls="navbarSupportedContent" aria-bs-expanded="false" >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ms-auto"></ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Dynamic route links -->
                    <li
                    class="nav-item"
                    v-for="route in routes"
                    :key="route.path"
                    >
                        <router-link class="nav-link" :to="route.path" > {{ route.meta.linkTxt }} </router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login" v-if="!user"> Login </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register" v-if="!user"> Register </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin" v-if="user"> {{ user.name }} </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
// Axios
import axios from "axios";
export default {
    data() {
        return {
           routes: [],
           user: null, 
        }
    },
    mounted() {
        //  Fills the list only with routes that contain linkTxt in the meta
        this.routes = this.$router.getRoutes().filter((route) => route.meta.linkTxt);
        this.fetchUser();
    },
    methods: {
        fetchUser() {
            axios.get("/api/user").then(resp=> {
                console.log(resp.data); // DEBUG
                this.user = resp.data;
                // Save the user data in loacalStorage
                localStorage.setItem("user", JSON.stringify(resp.data));
            })
            .catch((er) => {
                console.error("Utente non loggato"); // DEBUG
                // Remove the user data in the localStorage
                localStorage.removeItem("user");
            });
        }
    }
}
</script>

<style lang="scss" scoped>

</style>