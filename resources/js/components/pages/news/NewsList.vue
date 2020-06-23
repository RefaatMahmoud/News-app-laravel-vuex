<template>
  <div>
    <Header></Header>
    <div class="container mt-5">
      <div>
        <md-table>
          <md-table-row>
            <md-table-head>ID</md-table-head>
            <md-table-head>Title</md-table-head>
            <md-table-head>Body</md-table-head>
            <md-table-head>Actions</md-table-head>
          </md-table-row>
          <md-table-row v-for="new_item in this.$store.getters.getNews" :key="new_item.id">
            <md-table-cell width="10%">{{new_item.id}}</md-table-cell>
            <md-table-cell width="10%">{{new_item.title}}</md-table-cell>
            <md-table-cell width="70%">{{new_item.body}}</md-table-cell>
            <md-table-cell width="10%">
              <a href="javascript:void(0)" @click.prevent="remove(new_item.id)">
                <span class="material-icons text-danger">delete</span>
              </a>
              <router-link :to="{path:`news/edit/${new_item.id}`}">
                <span class="material-icons text-info">create</span>
              </router-link>
            </md-table-cell>
          </md-table-row>
        </md-table>
        <md-button class="md-raised md-primary">
          <router-link style="color: #FFF;text-decoration: none" to="/news/create">Create New</router-link>
        </md-button>
      </div>
    </div>
  </div>
</template>

<script>
import Header from "../../partials/Header";

export default {
  name: "news-list",
  data() {
    return {};
  },
  components: {
    Header
  },
  methods: {
    remove(id) {
      this.$store.dispatch("removeNew", id);
    }
  },
  mounted() {
    this.$store.dispatch("getNews");
  }
};
</script>

<style scoped>
</style>
