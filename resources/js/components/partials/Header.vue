<template>
    <header>
        <md-toolbar class="md-accent">
            <h3 class="md-title" style="flex: 1">News App</h3>
            <p style="padding-top:18px;" v-if="currentUser">{{currentUser}}</p>
            <md-menu md-size="medium" md-align-trigger>
                <md-button md-menu-trigger>
                    <md-icon>more_vert</md-icon>
                </md-button>
                <md-menu-content v-if="currentUser">
                    <md-menu-item>News List</md-menu-item>
                    <md-menu-item><a href="#!" @click.prevent="logout">Logout</a></md-menu-item>
                </md-menu-content>
            </md-menu>
        </md-toolbar>
    </header>
</template>

<script>
    export default {
        name: "Header",
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push({path: '/login'})
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser.user.name
            }
        }
    }
</script>

<style scoped>

</style>
