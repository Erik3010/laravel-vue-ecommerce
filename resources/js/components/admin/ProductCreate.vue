<template>
    <div>
        <app-navbar></app-navbar>

        <div class="site-section">
            <div class="container ">
                <!-- <div class="row"> -->
                <div class="col-md-12">
                    <h2 class="h3 mb-5 text-black text-center mb-5">Add Product </h2>
                </div>
                <div class="col-md-12">

                    
                    
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_name" class="text-black">Name <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="c_name" 
                                name="c_name" 
                                placeholder=""
                                v-model="data.name"
                            >
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_price" class="text-black">Price <span class="text-danger">*</span></label>
                            <input 
                                type="number" 
                                class="form-control" 
                                id="c_price" 
                                name="c_price" 
                                placeholder=""
                                v-model="data.price"
                            >
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_image" class="text-black">Image <span class="text-danger">*</span></label>
                            <input 
                                type="file" 
                                class="form-control" 
                                id="c_image" 
                                name="c_image" 
                                placeholder=""
                                @change="imageFile"
                            >
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_color" class="text-black">Color <span class="text-danger">*</span></label>
                            <select 
                                id="c_color" 
                                class="form-control"
                                v-model="data.color"
                            >
                                <option value="red">Red</option>    
                                <option value="blue">Blue</option>    
                                <option value="yellow">Yellow</option>     
                                <option value="pink">Pink</option>     
                                <option value="purple">Purle</option>     
                                <option value="green">Green</option>     
                            </select>
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_description" class="text-black">Description <span class="text-danger">*</span></label>
                            <textarea 
                                name="c_description" 
                                id="c_description" 
                                cols="30" 
                                rows="5" 
                                class="form-control" 
                                placeholder="Write your product description here..."
                                v-model="data.description"
                            ></textarea>
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_category" class="text-black">Category <span class="text-danger">*</span></label>
                            <select 
                                id="c_category" 
                                class="form-control"
                                v-model="data.category"
                            >
                                <option value="all">All</option>    
                                <option value="women">Women</option>    
                                <option value="children">Children</option>
                                <option value="men">Men</option>
                            </select>
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-lg-12 mt-3">
                            <button
                                class="btn btn-primary btn-lg btn-block"
                                @click="createProduct"
                            >
                            Create
                            </button>
                            <!-- <input type="submit" class="btn btn-primary btn-lg btn-block" value="Create"> -->
                        </div>
                        </div>
                    </div>

                    

                </div>
                <!-- </div> -->
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
            admin: localStorage.getItem('admin'),
            data: {
                name: '',
                price: '',
                color: '',
                description: '',
                category: '',
                token: localStorage.getItem('token')
            },
            picture: null
        }
    },
    components: {
        'app-navbar': Navbar,
        'app-footer': Footer
    },
    methods: {
        imageFile(event) {
            this.picture = event.target.files[0];
            console.log(this.picture)
        },
        createProduct() {
            let uploadImage = new FormData()
            uploadImage.set('picture', this.picture)
            // console.log(this.picture)

            axios.post('/api/product', uploadImage)
                .then(response => {
                    console.log(response)
                    // this.$router.push('/');
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>