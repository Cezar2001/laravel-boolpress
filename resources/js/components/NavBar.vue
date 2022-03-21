<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="/">Boolpress</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item" v-for="route in routes" :key="route.path">
                            <router-link :to="route.path" class="nav-link">
                                {{ route.meta.linkText }}
                            </router-link>   
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    data() {
        return {
            routes: []
        }
    },

    mounted() {
        this.routes = this.$router.getRoutes().filter((route) => !!route.meta.linkText);
    }
}
</script>

<style lang="scss" scoped>
</style>