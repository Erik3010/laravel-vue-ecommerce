<template>
    <div>
        <app-navbar></app-navbar>

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0">
                        <router-link to="/">
                            <a>Home</a> 
                        </router-link>
                        <span class="mx-2 mb-0">/</span> <strong class="text-black">{{ data.product.name }}</strong></div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <!-- <img :src="'images/' + product.picture" alt="Image" class="img-fluid"> -->
                        <img :src="'http://localhost:8000/images/' + data.product.picture" alt="Image" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <h2 class="text-black">{{ data.product.name }}</h2>
                        <p>{{ data.product.description }}</p>
                        <p><strong class="text-primary h4">${{ data.product.price }}</strong></p>
                        <div class="mb-1 d-flex">
                            <label for="option-sm" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input 
                                    type="radio" 
                                    id="option-sm" 
                                    name="shop-sizes"
                                    value="small"
                                    checked
                                    v-model="data.data.size"    
                                ></span> <span class="d-inline-block text-black">Small</span>
                            </label>
                            <label for="option-md" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input 
                                    type="radio" 
                                    id="option-md" 
                                    name="shop-sizes"
                                    value="medium"
                                    v-model="data.data.size"
                                ></span> <span class="d-inline-block text-black">Medium</span>
                            </label>
                            <label for="option-lg" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input 
                                    type="radio" 
                                    id="option-lg" 
                                    name="shop-sizes"
                                    value="large"
                                    v-model="data.data.size"    
                                ></span> <span class="d-inline-block text-black">Large</span>
                            </label>
                            <label for="option-xl" class="d-flex mr-3 mb-3">
                                <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input 
                                    type="radio" 
                                    id="option-xl" 
                                    name="shop-sizes"
                                    value="extra_large"
                                    v-model="data.data.size"    
                                ></span> <span class="d-inline-block text-black"> Extra Large</span>
                            </label>
                        </div>
                        <div class="mb-5">
                            <div class="input-group mb-3" style="max-width: 120px;">
                                <div class="input-group-prepend">
                                    <button 
                                        class="btn btn-outline-primary" 
                                        type="button"
                                        @click="minusAmount"
                                        :disabled="disabled"
                                    >&minus;</button>
                                </div>
                                <input 
                                    type="number" 
                                    class="form-control text-center" 
                                    value="1" 
                                    placeholder="" 
                                    aria-label="Example text with button addon" aria-describedby="button-addon1"
                                    v-model="data.data.quantity"
                                    >
                                <div class="input-group-append">
                                    <button 
                                        class="btn btn-outline-primary" 
                                        type="button"
                                        @click="plusAmount"
                                    >&plus;</button>
                                </div>
                            </div>
                        </div>
                        <!-- <p><a href="cart.html" class="buy-now btn btn-sm btn-primary">Add To Cart</a></p>   -->
                        <button 
                            class="buy-now btn btn-sm btn-primary"
                            @click.prevent="addCart"    
                        >Add to Cart</button>     
                    </div> 
                </div> 
            </div>
        </div>       

        <div class="site-section block-3 site-blocks-2 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Featured Products</h2>
                </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel">
                    <div class="item">
                        <div class="block-4 text-center">
                        <figure class="block-4-image">
                            <img src="http://localhost:8000/images/cloth_1.jpg" alt="Image placeholder" class="img-fluid">
                        </figure>
                        <div class="block-4-text p-4">
                            <h3><a href="#">Tank Top</a></h3>
                            <p class="mb-0">Finding perfect t-shirt</p>
                            <p class="text-primary font-weight-bold">$50</p>
                        </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="block-4 text-center">
                        <figure class="block-4-image">
                            <img src="http://localhost:8000/images/shoe_1.jpg" alt="Image placeholder" class="img-fluid">
                        </figure>
                        <div class="block-4-text p-4">
                            <h3><a href="#">Corater</a></h3>
                            <p class="mb-0">Finding perfect products</p>
                            <p class="text-primary font-weight-bold">$50</p>
                        </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="block-4 text-center">
                        <figure class="block-4-image">
                            <img src="http://localhost:8000/images/cloth_2.jpg" alt="Image placeholder" class="img-fluid">
                        </figure>
                        <div class="block-4-text p-4">
                            <h3><a href="#">Polo Shirt</a></h3>
                            <p class="mb-0">Finding perfect products</p>
                            <p class="text-primary font-weight-bold">$50</p>
                        </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="block-4 text-center">
                        <figure class="block-4-image">
                            <img src="http://localhost:8000/images/cloth_3.jpg" alt="Image placeholder" class="img-fluid">
                        </figure>
                        <div class="block-4-text p-4">
                            <h3><a href="#">T-Shirt Mockup</a></h3>
                            <p class="mb-0">Finding perfect products</p>
                            <p class="text-primary font-weight-bold">$50</p>
                        </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="block-4 text-center">
                        <figure class="block-4-image">
                            <img src="http://localhost:8000/images/shoe_1.jpg" alt="Image placeholder" class="img-fluid">
                        </figure>
                        <div class="block-4-text p-4">
                            <h3><a href="#">Corater</a></h3>
                            <p class="mb-0">Finding perfect products</p>
                            <p class="text-primary font-weight-bold">$50</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <app-footer></app-footer>    
    </div>
</template>

<script>
import Navbar from './layout/Navbar.vue';
import Footer from './layout/Footer.vue';

import axios from 'axios';

export default {
    data() {
        return {
            data : {
                product: [],
                data: {
                    size: '',
                    quantity: 1,
                    token: localStorage.getItem('token')
                }
            },
            disabled: false
        }
    },
    components: {
        'app-navbar': Navbar,
        'app-footer': Footer
    },
    created() {
        let id = this.$route.params.id

        axios.get('/api/product/' + id)
            .then(response => {
                this.data.product = response.data.data
                console.log(this.data.product)
            })
            .catch(error => {
                console.log(error)
            })

        this.checkDisabled();
    },
    methods: {
        checkDisabled() {
            this.disabled = false
            if(this.data.data.quantity == 1) {
                this.disabled = true
            }
        },
        minusAmount() {
            this.data.data.quantity -= 1;
            this.checkDisabled();
        },
        plusAmount() {
            this.data.data.quantity += 1;
            this.checkDisabled();
        },
        addCart() {
            axios.post('/api/cart', this.data)
                .then(response => {
                    console.log(response)
                    this.$router.push('/cart')
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>