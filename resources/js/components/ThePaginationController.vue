<template>
    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item mx-2">
                            <a class="page-link text-dark" @click="$emit('previousPage')">Previous</a>
                        </li>
                        <li
                        class="page-item"
                        v-for="page in pagination.last_page"
                        :key="page"
                        >
                            <a class="page-link text-dark" @click="$emit('getPage', page)">{{ page }}</a>
                        </li>
                        <li class="page-item mx-2">
                            <a class="page-link text-dark" @click="$emit('nextPage')">Next</a>
                        </li>
                    </ul>
                </nav>
</template>

<script>
export default {
    props: {
        pagination: Object,
    }
}
</script>

<style lang="scss" scoped>
.page-link{
        cursor: pointer;
    }
</style>