<template>
    <div class="col">
        <div class="card">
            <img :src="getPostImage(post)" :alt="post.title + ' image'" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text" v-html="post.content"></p>
                <div>
                    <span> <strong>Autore: </strong> {{ post.user.name }} </span>
                    <br />
                    <span> <strong>Data: </strong> {{ getCreationDate(post) }} </span>
                    <br />
                    <span>
                        <strong>Category: </strong>
                        <em v-if="post.category">{{ post.category.name }}</em>
                        <em v-else>Nessuna categoria</em>
                    </span>
                </div>
            </div>
            <div class="card-footer">
                <router-link :to="{name:'posts.show', params:{post: post.slug}}" >Dettagli</router-link>
            </div>
        </div>
    </div>    
</template>

<script>
import moment from 'moment';
export default {
    props: {
        post: Object,
    },
    methods: {
        getPostImage(post) {
            if(post.image) {
                return post.image;
            } else if(post.imageLink) {
                return post.imageLink;
            } else {
                return 'http://www.asdalcione.it/wp-content/uploads/2016/08/jk-placeholder-image-1.jpg';
            }
        },
        getCreationDate(post) {
            if(moment().diff(post.created_at, 'hours') >= 12){
                return moment(post.created_at).format('DD/MM/YYYY [-] HH:mm');
            } else {
                return moment(post.created_at).fromNow()
            }
        }
    },
}
</script>

<style lang="scss" scoped>

</style>