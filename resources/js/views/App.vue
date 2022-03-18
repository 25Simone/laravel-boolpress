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

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link text-dark" @click="fetchPosts(pagination.current_page - 1)">Previous</a>
                    </li>
                    <li
                    class="page-item"
                    v-for="page in pagination.last_page"
                    :key="page"
                    >
                        <a class="page-link" @click="fetchPosts(page)">{{ page }}</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link text-dark" @click="fetchPosts(pagination.current_page + 1)">Next</a>
                    </li>
                </ul>
            </nav>
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
            // Pagination
            pagination: {},
        }
    },
    mounted() {
        this.fetchPosts();
    },
    methods: {
        async fetchPosts(page = 1) {
            // axios.get("/api/posts").then((resp) => {
            //     this.posts = resp.data;
            // })

            if (page < 1) {
                page = 1;
            };
            if (page > this.pagination.last_page) {
                page = this.pagination.last_page;
            };

            // fetch posts using async await
            const resp = await axios.get("/api/posts?page=" + page);
            // Save the response in a variable
            this.pagination = resp.data;
            // Save only the posts data
            this.posts = resp.data.data;
        },
    }
    
}
</script>

<style lang="sss" scoped>

</style>