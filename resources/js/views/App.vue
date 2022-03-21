<template>
    <div>
        <NavBar />

        <div class="container py-3">
            <h1>Ecco alcuni post di Boolpress</h1>

            <div class="row">
                 <PostCard v-for="post of posts" :key="post.id" :post="post"></PostCard>
            </div>
        </div>

        <Footer />

    </div>
</template>

<script>

import NavBar from "../components/NavBar.vue";
import axios from "axios";
import PostCard from "../components/PostCard.vue";
import Footer from "../components/Footer.vue";

export default {
    name: "app",
    components: {
        NavBar,
        PostCard,
        Footer
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