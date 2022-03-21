<template>
    <div>

        <div class="container py-3">
            <h5>Home</h5>
            <h1>Ecco alcuni post di Boolpress</h1>

            <div class="row">
                 <PostCard v-for="post of posts" :key="post.id" :post="post"></PostCard>
            </div>
        </div>

    </div>
</template>

<script>

import axios from "axios";
import PostCard from "../components/PostCard.vue";

export default {
    name: "app",
    components: {
        PostCard,
    },

    data() {
        return {
            posts: [],
        }
    },

    methods: {
        getPosts() {
            axios.get("/api/posts").then(resp => {
                this.posts = resp.data;
            });
        },
    },

    mounted() {
        this.getPosts();
    }
}
</script>

<style lang="sass" scoped>

</style>