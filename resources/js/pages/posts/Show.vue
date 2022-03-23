<template>
    <div>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <div>
                            Dettagli post: <strong>{{ post.title }}</strong>
                        </div>
                    </div>
          
                    <div class="card-body">
                        <div class="post-image">
                            <img class="img-fluid rounded" :src="getPostImage(post)" alt="post image">
                        </div>
                        <strong>Content:</strong>
                        <p v-html="post.content"></p>
                        <div>
                            <strong>Categoria: </strong> 
                            <span v-if="post.category">{{ post.category.name }}</span>
                            <span v-else>Nessuna categoria</span>
                            <br />
                            <strong>Tags: </strong>
                            <span v-for="(tag, i) in post.tags" :key="i" class="badge bg-success mx-1"> {{tag.name}} </span>        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
// Axios
import axios from "axios";

export default {
    data() {
        return {
            post: {}
        }
    },
    mounted() {
        this.fetchPost();
    },
    methods: {
        async fetchPost() {
            try {
                const resp = await axios.get(`/api/posts/${this.$route.params.post}`);
                // Save the response in the post object
                this.post = resp.data;
            } catch(er) {
                this.$router.replace({name: "error", params: {message: er.message}});
                console.log(er.message);
            }
        },
        getPostImage(post) {
            if(post.image) {
                return post.image;
            } else if(post.imageLink) {
                return post.imageLink;
            } else {
                return 'http://www.asdalcione.it/wp-content/uploads/2016/08/jk-placeholder-image-1.jpg';
            }
        },
    }
}
</script>

<style lang="scss" scoped>
.post-image{
    img{
        width: 100%;
    }
}

</style>