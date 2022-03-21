<template>
    <div class="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">ERROR</h5>
                </div>
                <div class="modal-body">
                  <p>{{errorMessage}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            errorMessage: "",
        }
    },
    mounted() {
        // console.log(this.$route); DEBUG
        this.errorMessage = this.$route.params.message;
    }
}
</script>

<style lang="scss" scoped>

</style>