<template>
    <div>
        <app-navbar></app-navbar>
        <div class="bg-light py-3">
        <div class="container">
            <div class="row">
            <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Login</strong></div>
            </div>
        </div>
        </div>  

        <div class="site-section">
        <div class="container d-flex justify-content-center">
            <div class="row">
            <div class="col-md-12">
                <h2 class="h3 mb-3 text-black text-center">Login</h2>
            </div>
            <div class="col-md-12">

                <form @submit.prevent="login">
                
                <div class="p-3 p-lg-5 border">
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
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Login">
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
            data : {
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
        login() {
            axios.post('/api/login', this.data)
                .then(response => {
                    if(response.data.message=="Success") {
                        localStorage.setItem('token', response.data.token);
                        localStorage.setItem('admin', response.data.is_admin);
                        // alert('success')
                        this.$router.push('/')
                    }else{
                        alert('err')
                    }
                    // console.log(response)
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
}
</script>