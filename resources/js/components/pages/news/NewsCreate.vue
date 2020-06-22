<template>
    <div>
        <Header></Header>
        <div class="container mt-5">
            <form class="md-layout" @submit.prevent="createNew">
                <md-card class="md-layout-item">
                    <md-card-content>
                        <md-field>
                            <label for="title">Title</label>
                            <md-input type="title" name="title" id="title" autocomplete="off" v-model="formData.title" required/>
                        </md-field>
                    </md-card-content>
                    <md-card-content>
                        <md-field>
                            <label for="body">Body</label>
                            <md-input type="body" name="body" id="body" autocomplete="off" v-model="formData.body" required/>
                            <span class="md-error" v-if="errors['body']">{{errors['body']}}</span>
                        </md-field>
                    </md-card-content>
                    <md-card-actions>
                        <md-button type="button" class="md-accent">
                            <router-link to="/news" class="md-accent cancel-link">Cancel</router-link>
                        </md-button>
                        <md-button type="submit" class="md-primary">Create</md-button>
                    </md-card-actions>
                </md-card>
            </form>
        </div>
    </div>
</template>

<script>
    import Header from "../../partials/Header";
    
    export default {
        name: "new-create",
        data() {
            return {
                formData: {
                    title: "",
                    body: ""
                },
                errors: []
            }
        },
        components: {
            Header
        },
        methods: {
            async createNew(){
                await this.$store.dispatch('createNew',this.formData);
                this.$router.push('/news');
            }
        }
    }
</script>

<style scoped>
.cancel-link{
    text-decoration: none !important;
}
</style>
