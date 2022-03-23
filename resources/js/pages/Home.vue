<template>
    <div>
        <!-- Title -->
        <h1 class="text-center title py-3 fw-bold">POSTS</h1>
        <!-- Searchbar -->
        <div class="d-flex justify-content-end">
            <input
            type="text"
            class="form-input m-3 searchbar"
            placeholder="Cosa vuoi cercare?"
            v-model="searchedText"
            @keyup="searchPosts"
      />
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <!-- Card -->
            <the-post-card v-for="post in posts" :key="post.id" :post="post"></the-post-card>
        </div>
        <!-- Pagination Controller -->
        <div class="d-flex justify-content-center container-fluid py-5">
            <the-pagination-controller
            @previousPage="previousPage"
            @nextPage="nextPage"
            @getPage="getPage"
            :pagination="pagination"
            v-if="!searchedText"
            >
            </the-pagination-controller>
        </div>
    </div>
</template>

<script>
import ThePostCard from "../components/ThePostCard.vue";
import ThePaginationController from '../components/ThePaginationController.vue';
// Axios
import axios from 'axios';

export default {
    components: {
      ThePostCard,
      ThePaginationController,
    },
    data() {
        return {
            posts: [],
            // Pagination
            pagination: {},
            searchedText: null,
        }
    },
    mounted() {
        this.fetchPosts();
    },
    methods: {
        async fetchPosts(page = 1, searchedText = null) {
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
            const resp = await axios.get("/api/posts", {
                params: {
                    page,
                    filter: searchedText,
                }
            });
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

        searchPosts() {
            this.fetchPosts(1, this.searchedText)
        }
    }
};
</script>

<style lang="scss" scoped>
.searchbar{
    background-color: #222;
    color: #fff;
    border-radius: 15px;
    padding: 5px 8px;
    width: 20%;
}
</style>
