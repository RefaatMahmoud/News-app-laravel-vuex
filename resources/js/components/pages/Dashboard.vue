<template>
  <div>
    <Header></Header>
    <div class="container">
      <div style="padding: 20px">
        Welcome
        <strong>Mr.{{currentUser.user.name}}</strong> in your dashboard
        <br />
        <router-link to="/news">News</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import Header from "../partials/Header";

export default {
  name: "dashboard",
  components: {
    Header
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser;
    }
  }
};
</script>

<style scoped>
</style>
