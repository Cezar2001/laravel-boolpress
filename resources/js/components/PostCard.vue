<template>
    <div class="col-2">
        <div class="card">
            <div class="card-body">

                <!-- <img :src="getPostCover(post)" class="card-img-top" /> -->

                <h4 class="card-title">{{ post.title }}</h4>

                <div class="card-text" v-html="post.content"></div>

                <div class="">Autore: {{ post.user.name }}</div>

                <div>Data: {{ post.created_at }}</div>

                <div v-if="post.category">{{ post.category.code }}</div>

                <div class="card-text" v-for="tag of post.tags" :key="tag.id">#{{ tag.name }}</div>

                <a href="#">Dettagli</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  props: {
    post: Object,
  },
  
};
</script>

<style lang="scss" scoped>
</style>