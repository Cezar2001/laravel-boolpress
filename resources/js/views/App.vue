<template>
    <div>
        <NavBar />

        <div class="container">
            <router-view></router-view>
        </div>

        <Footer />

    </div>
</template>

<script>

import NavBar from "../components/NavBar.vue";
import Footer from "../components/Footer.vue";

export default {
    components: {
        NavBar,
        Footer
    },
}
</script>

<style lang="sass" scoped>

</style>