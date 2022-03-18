<template>
    <div>
        <!-- Navbar -->
        <the-navbar class="bg-dark navbar-dark"></the-navbar>
        <h1 class="text-center title py-3 fw-bold">POSTS</h1>
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

            <div class="d-flex justify-content-center container-fluid py-5">
                <the-pagination-controller @previousPage="previousPage" @nextPage="nextPage" @getPage="getPage" :pagination="pagination"></the-pagination-controller>
                <!-- <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item mx-2">
                            <a class="page-link text-dark" @click="fetchPosts(pagination.current_page - 1)">Previous</a>
                        </li>
                        <li
                        class="page-item"
                        v-for="page in pagination.last_page"
                        :key="page"
                        >
                            <a class="page-link" @click="fetchPosts(page)">{{ page }}</a>
                        </li>
                        <li class="page-item mx-2">
                            <a class="page-link text-dark" @click="fetchPosts(pagination.current_page + 1)">Next</a>
                        </li>
                    </ul>
                </nav> -->
            </div>
        </main>
    </div>
</template>

<script>
// Components
import TheNavbar from "../components/TheNavbar.vue";
import ThePostCard from "../components/ThePostCard.vue";
import ThePaginationController from '../components/ThePaginationController.vue';
// Axios
import axios from 'axios';

export default {
    components: {
      TheNavbar,
      ThePostCard,
      ThePaginationController,
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
        previousPage() {
            this.fetchPosts(this.pagination.current_page - 1);
            console.log('previousPage eseguita');
        },
        nextPage() {
            this.fetchPosts(this.pagination.current_page + 1);
            console.log('nextPage eseguita');
        },
        getPage(page) {
            this.fetchPosts(page);
            console.log('getPage eseguita');
        },
    }
    
}
</script>

<style lang="scss" scoped>
</style>