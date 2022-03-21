<template>
    <div class="col-6">
        <div class="card">
            <div class="card-body">

                <img :src="getPostCover()" class="card-img-top" />

                <h4 class="card-title">{{ post.title }}</h4>

                <div class="card-text" v-html="post.content"></div>

                <div>Data: {{ formatDate(post.created_at) }}</div>

                <div v-if="post.category">{{ post.category.code }}</div>

                <div class="card-text" v-for="tag of post.tags" :key="tag.id">#{{ tag.name }}</div>

                <a href="#">Dettagli</a>
            </div>
        </div>
    </div>
</template>

<script>
import dayjs from "dayjs";

export default {
  props: {
    post: Object,
  },

  methods: {
    getPostCover() {
      return "https://www.logistec.com/wp-content/uploads/2017/12/placeholder.png"
    },

    formatDate(date) {
      return dayjs(date).format('DD/MM/YYYY HH:mm');
    }
  },
};
</script>

<style lang="scss" scoped>
  .card{
    margin-top: 25px;
  }
</style>