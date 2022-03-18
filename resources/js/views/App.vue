<template>
    <div>
        <!-- Navbar -->
        <the-navbar></the-navbar>
        <h1>Pagina in vue.js</h1>
        <!-- Main -->
        <main class="container py-4">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <!-- Card -->
                <the-post-card
                v-for="post in posts"
                :key="post.id"
                :post="post"
                >
                </the-post-card>
            </div>
        </main>
    </div>
</template>

<script>
// Components
import TheNavbar from "../components/TheNavbar.vue";
import ThePostCard from "../components/ThePostCard.vue";
// Axios
import axios from 'axios';

export default {
    components: {
      TheNavbar,
      ThePostCard,
    },
    data() {
        return {
            posts: [],
        }
    },
    mounted() {
        this.fetchPosts();
    },
    methods: {
        async fetchPosts() {
            // axios.get("/api/posts").then((resp) => {
            //     this.posts = resp.data;
            // })
            // fetch posts using async await
            const resp = await axios.get("/api/posts");
            this.posts = resp.data;
        },
    }
    
}
</script>

<style lang="sss" scoped>

</style>