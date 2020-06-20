<template>
    <div>
        <Header></Header>
        <div class="container mt-5">
            <form class="md-layout" @submit.prevent="createNew">
                <md-card class="md-layout-item">
                    <md-card-content>
                        <md-field>
                            <label for="title">Title</label>
                            <md-input type="title" name="title" id="title" autocomplete="off" v-model="form.title"/>
                        </md-field>
                    </md-card-content>
                    <md-card-content>
                        <md-field>
                            <label for="body">Body</label>
                            <md-input type="body" name="body" id="body" autocomplete="off" v-model="form.body"/>
                            <span class="md-error" v-if="errors['body']">{{errors['body']}}</span>
                        </md-field>
                    </md-card-content>
                    <md-card-actions>
                        <md-button type="submit" class="md-primary">Create</md-button>
                    </md-card-actions>
                </md-card>
            </form>
        </div>
    </div>
</template>

<script>
    import Header from "../../partials/Header";
    import * as news_services from "../../../services/news_service";

    export default {
        name: "create-list",
        data() {
            return {
                form: {
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
            async createNew() {
                try {
                    let data = new FormData();
                    data.append('title', this.form.title);
                    data.append('body', this.form.body);
                    const response = await news_services.create(data);
                    if (response.status === 201) {
                        return this.$router.push('/news');
                    }
                } catch (e) {
                    console.log(e);
                }
            }
        }
    }
</script>

<style scoped>

</style>
