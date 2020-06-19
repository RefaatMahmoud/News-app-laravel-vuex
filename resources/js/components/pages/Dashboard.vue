<template>
    <div class="container">
        <Header></Header>
        <div>
            {{welcome}}
        </div>
    </div>
</template>

<script>
    import Header from "../partials/Header";

    export default {
        name: "dashboard",
        components:{
          Header
        },
        computed: {
            welcome() {
                return this.$store.getters.welcome
            }
        }
    }
</script>

<style scoped>

</style>
