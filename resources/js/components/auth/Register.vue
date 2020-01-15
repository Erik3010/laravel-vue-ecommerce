<template>
    <div>
        <app-navbar></app-navbar>
        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Register</strong></div>
                </div>
            </div>
        </div>  

        <div class="site-section">
        <div class="container d-flex justify-content-center">
            <div class="row">
            <div class="col-md-12">
                <h2 class="h3 mb-3 text-black text-center">Register</h2>
            </div>
            <div class="col-md-12">

                <form @submit.prevent="register">
                
                <div class="p-3 p-lg-5 border">
                    <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_fname" class="text-black">Username <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="c_fname" 
                            name="c_fname"
                            v-model="data.username"    
                        >
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_email" class="text-black">Email <span class="text-danger">*</span></label>
                        <input 
                            type="email" 
                            class="form-control" 
                            id="c_email" 
                            name="c_email" 
                            placeholder=""
                            v-model="data.email"    
                        >
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-12">
                        <label for="c_password" class="text-black">Password <span class="text-danger">*</span></label>
                        <input 
                            type="password" 
                            class="form-control" 
                            id="c_password" 
                            name="c_password" 
                            placeholder=""
                            v-model="data.password"    
                        >
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Register Now">
                    </div>
                    </div>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
        <app-footer></app-footer>  
    </div>
</template>

<script>
import Navbar from '../layout/Navbar.vue';
import Footer from '../layout/Footer.vue';

import axios from 'axios';

export default {
    data() {
        return {
            data: {
                username: '',
                email: '',
                password: ''
            }
        }
    },
    components: {
        'app-navbar' : Navbar,
        'app-footer' : Footer
    },
    created() {
        if(localStorage.getItem('token')) {
            this.$router.push('/')
        }
    },
    methods: {
        register() {
            axios.post('/api/register', this.data)
                .then(response => {
                    // console.log(response)
                    localStorage.setItem('token', response.data.token);
                    this.$router.push('/')
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
}
</script>