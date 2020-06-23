<template>
  <div>
    <Header></Header>
    <div class="container mt-5">
      <form class="md-layout" @submit.prevent="updateNew">
        <md-card class="md-layout-item">
          <md-card-content>
            <md-field>
              <label for="title">Title</label>
              <md-input
                type="title"
                name="title"
                id="title"
                autocomplete="off"
                v-model="formData.title"
                required
              />
            </md-field>
          </md-card-content>
          <md-card-content>
            <md-field>
              <label>Body</label>
              <md-textarea v-model="formData.body" name="body" required></md-textarea>
            </md-field>
          </md-card-content>
          <md-card-actions>
            <md-button type="button" class="md-accent">
              <router-link to="/news" class="md-accent cancel-link">Cancel</router-link>
            </md-button>
            <md-button type="submit" class="md-primary">Update</md-button>
          </md-card-actions>
        </md-card>
      </form>
    </div>
  </div>
</template>

<script>
import Header from "../../partials/Header";
import axios from "axios";

export default {
  name: "new-update",
  data() {
    return {
      formData: {
        id: "",
        title: "",
        body: ""
      },
      errors: []
    };
  },
  components: {
    Header
  },
  methods: {
    async updateNew() {
      await this.$store.dispatch("updateNew",this.formData);
      this.$router.push("/news");
    }
  },
  created() {
    let apiUrl = `${this.$store.getters.baseApiUrl}/news/${this.$route.params.id}`;
    axios
      .get(apiUrl, {
        headers: {
          Authorization: `Bearer ${this.$store.getters.currentUser.token}`
        }
      })
      .then(response => {
        this.formData.id = response.data.data.id;
        this.formData.title = response.data.data.title;
        this.formData.body = response.data.data.body;
      })
      .catch(error => console.log(error));
  }
};
</script>

<style scoped>
</style>
