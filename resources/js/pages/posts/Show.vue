<template>
    <div>
        {{ post.title }}
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
            const resp = await axios.get(`/api/posts/${this.$route.params.post}`);
            console.log(resp.data);
            this.post = resp.data;
        }
    }
}
</script>

<style lang="scss" scoped>

</style>