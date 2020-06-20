<template>
    <form class="md-layout" @submit.prevent="authenticate">
        <md-card class="md-layout-item">
            <md-card-header>
                <div style="text-align: center" class="md-title">Login</div>
            </md-card-header>
            <md-card-content>
                <md-field>
                    <label for="email">Email</label>
                    <md-input type="email" name="email" id="email" autocomplete="off" v-model="form.email"/>
                </md-field>
            </md-card-content>
            <md-card-content>
                <md-field>
                    <label for="password">Password</label>
                    <md-input type="password" name="password" id="password" autocomplete="off" v-model="form.password"/>
                </md-field>
            </md-card-content>
            <md-card-actions>
                <md-button type="submit" class="md-primary">Login</md-button>
            </md-card-actions>
        </md-card>
    </form>
</template>

<script>
    import {login} from "../../helper/auth"

    export default {
        name: "Login",
        data() {
            return {
                form: {
                    email: "",
                    password: "",
                },
                error: null
            }
        },
        methods: {
            authenticate() {
                login(this.$data.form).then((res) => {
                    this.$store.commit("loginSuccess", res);
                    this.$router.push({path: '/'});
                }).catch((error) => {
                    this.$store.commit("loginFailed", {error});
                });
            }
        }
    }
</script>

<style scoped>
    form {
        display: flex;
        flex-wrap: wrap;
        margin: 0 auto;
        width: 30%;
    }
</style>
