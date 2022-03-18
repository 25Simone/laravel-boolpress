<template>
    <div class="col">
        <div class="card">
            <img :src="getPostImage(post)" :alt="post.title + ' image'" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text" v-html="post.content"></p>
            </div>
        </div>
    </div>    
</template>

<script>
export default {
    props: {
        post: Object,
    },
    methods: {
        getPostImage(post) {
            return post.image ?? 'http://www.asdalcione.it/wp-content/uploads/2016/08/jk-placeholder-image-1.jpg';
        }
    }
}
</script>

<style lang="scss" scoped>

</style>