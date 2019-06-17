<template>
    <div class = "home">
        <div class = "row">
            <div class="col l2"></div>
            <div class = "col l4">
                <div class = "card" id = "left">
                    <div class = "card-header">
                        <h5 class = "card-title center-align card-heading">Sign up</h5>
                    </div>
                    <div class="card-content">
                        <form @submit.prevent = "signUp">      
                            <label for = "username">Username</label>                            
                            <input type = "text" id = "username" name = "username" v-model = "username" required/><br><br>
                            <label for = "password">Password</label>
                            <input type = "password" name = "password" id = "password" v-model = "password" required/><br><br>
                            <label for = "password_confirmation">Re-enter Password</label>
                            <input type = "password" name = "password_confirmation" id = "password_confirmation" v-model = "passwordConfirmation" required/>
                            <div class="center-align">
                                <p class = "red-text darken-2">
                                    <span v-for = "(error,index) in errors" :key = "index">{{error}}</span><br>        
                                </p>
                                <p class = "green-text darken-2" v-if = "validated">Data validated</p>
                                <button type = "submit" class = "btn btn-medium black">Sign up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col l4">
                <div class = "card" id = "right">
                    <div class = "card-header">
                         <h5 class = "card-title card-heading center-align">Sign in</h5>
                    </div>
                    <div class="card-content">
                        <form @submit.prevent = "signIn">
                            <label for = "username_signin">Username</label>
                            <input type = "text" name = "username_signin" id = "username_signin" v-model = "usernameSignin"><br><br>
                            <label for = "password_signin">Password</label>
                            <input type = "password" name = "password_signin" id = "password_signin" v-model = "passwordSignin"><br><br>
                            <div class="center-align" id = "signin-btn">
                                 <p class = "red-text darken-2">
                                    <span v-for = "(error,index) in errorsSignin" :key = "index">{{error}}</span><br>        
                                </p>
                                <p class = "green-text darken-2" v-if = "validatedSignin">Data validated</p>
                                <button type = "submit" class = "btn btn-medium black">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import domain from '../domainconfig'
export default {
    name: 'Home',
    data() {
        return {
            username: null,
            password: null,
            passwordConfirmation: null,
            usernameSignin: null,
            passwordSignin: null,
            errors: [],
            errorsSignin: [],
            validated: false,
            validatedSignin: false
        }
    },
    methods: {
        signUp() {
            if(this.username && this.password && this.passwordConfirmation) {
                this.errors = []
                if(this.password === this.passwordConfirmation) {
                    this.errors = []
                    let uri = domain + "/api/signup"
                    axios.post(uri,{uuid: this.$uuid.v4(), username: this.username, password: this.password})
                    .then(response => {
                        if(response.data == "success") {
                            this.validated = true
                            this.$router.push({name: 'chat', params: {username: this.username, auth: true}})
                        }
                        else {
                            this.validated = false
                            this.errors.push("Username already exists")
                        }
                    }).catch(err => {
                        console.log("Check your controller logic")
                    })
                }
                else {
                    this.errors.push('Passwords do not match')
                }
            }
            else {
                this.errors.push('Please make sure you\'ve entered all the required fields')
            }
        },
        signIn() {
            if(this.usernameSignin && this.passwordSignin) {
                this.errorsSignin = []
                let uri = domain + "/api/signin"
                axios.post(uri,{username: this.usernameSignin, password: this.passwordSignin})
                .then(response => {
                    if(response.data == true) {
                        this.validatedSignin = true
                        this.$router.push({name: 'chat', params: {username: this.usernameSignin, auth: true}})
                    }
                    else {
                        this.validatedSignin = false
                        this.errorsSignin.push("Please check your credentials")
                    }
                }).catch(err => {
                    console.log(err)
                })
            }
        }
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
.row {
    margin : 100px auto;
}
.card-heading {
  
    padding : 10px;
}
form input {
    border: 1px solid #aaa !important;
}

</style>
