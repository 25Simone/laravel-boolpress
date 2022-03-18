<template>
    <div>
        <the-navbar></the-navbar>
        <h1>Pagina in vue.js</h1>
    </div>
</template>

<script>
import TheNavbar from "../components/TheNavbar.vue";
import axios from 'axios';

export default {
    components: {
      TheNavbar
    },
    data() {
        return {
            
        }
    },
    mounted() {
        axios.get("/api/posts").then((response)=> {
            console.log(response.data) // DEBUG
        })
    }
    
}
</script>

<style lang="sss" scoped>

</style>