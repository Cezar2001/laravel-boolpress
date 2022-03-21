<template>
    <div>
        <h5 class="py-2">Dettagli del Post</h5>

        <img :src="getPostCover()" class="card-img-top" />

        <h4>{{ post.title }}</h4>

        <div class="card-text" v-html="post.content"></div>

        <!-- <div>Data: {{ formatDate(post.created_at) }}</div> -->

        <div v-if="post.category">{{ post.category.code }}</div>

        <div class="card-text" v-for="tag of post.tags" :key="tag.id">#{{ tag.name }}</div>

    </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
      return{
          post: {},
      }
  },

  methods: {
    async getPosts() {
        try {
            const response = await axios.get("/api/posts/" + this.$route.params.post);
            this.post = response.data;

        } catch(er) {
            this.$router.replace({
                name: "error"
            });
        }
    },

    getPostCover() {
      return "https://www.logistec.com/wp-content/uploads/2017/12/placeholder.png"
    },
  },
    mounted() {
        this.getPosts();
    },
};
</script>

<style lang="scss" scoped>
  .card{
    margin-top: 25px;
  }
</style>