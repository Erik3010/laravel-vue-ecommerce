<template>
    <div>
        <app-navbar></app-navbar>
        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Shop</strong></div>
                </div>
            </div>
        </div>

        <div class="site-section">
        <div class="container">

            <div class="row mb-5">
            <div class="col-md-9 order-2">

                <div class="row">
                <div class="col-md-12 mb-5">

                    <div v-if="admin == 1">
                        <h2>
                            <router-link to="/">
                                <a>Welcome Admin!</a>
                            </router-link>
                        </h2>
                        <p>Make a new Product here!</p>
                        <router-link to="/create">
                            <a class="btn btn-primary btn-sm mb-5 text-white">Add Product</a>    
                        </router-link>  
                    </div>

                    <div class="float-md-left mb-4"><h2 class="text-black h5">Shop All</h2></div>
                    <div class="d-flex">
                    <div class="dropdown mr-1 ml-md-auto">
                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @click.prevent="latest">
                        Latest
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                        <a class="dropdown-item" href="#">Men</a>
                        <a class="dropdown-item" href="#">Women</a>
                        <a class="dropdown-item" href="#">Children</a>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference" data-toggle="dropdown">Reference</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                        <a class="dropdown-item" href="#">Relevance</a>
                        <a class="dropdown-item" href="#">Name, A to Z</a>
                        <a class="dropdown-item" href="#">Name, Z to A</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Price, low to high</a>
                        <a class="dropdown-item" href="#">Price, high to low</a>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="row mb-5">

                <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up" v-for="(product, index) in products" :key="product.id">
                    <div class="block-4 text-center border">
                    <figure class="block-4-image">
                        <router-link :to="{ name:'single', params: {id: product.id} }">
                            <img :src="'./images/' + product.picture" alt="Image placeholder" class="img-fluid">
                        </router-link>
                    </figure>
                    <div class="block-4-text p-4">
                        <h3>
                            <router-link :to="{ name: 'single', params: {id: product.id} }">
                                {{ product.name }}
                            </router-link>
                        </h3>
                        <p class="mb-0">{{ product.description }}</p>
                        <p class="text-primary font-weight-bold">${{ product.price }}</p>
                    </div>
                    <div v-if="admin == 1">
                        <router-link :to="{ name: 'edit', params: {id: product.id} }">
                            <a class="btn btn-warning btn-sm mr-2 mb-4 text-white">Edit</a>
                        </router-link>
                        <button 
                            class="btn btn-danger btn-sm mb-4 text-white"
                            @click.prevent="deleteProduct(product.id, index)"    
                        >Delete</button>
                    </div>
                    </div>
                </div>
                
                </div>
                <div class="row" data-aos="fade-up">
                <div class="col-md-12 text-center">
                    <div class="site-block-27">
                    <ul>
                        <li
                            :class="{ disabled: !pagination.prev_page_url }"
                            @click.prevent="fetchProduct(pagination.prev_page_url)"
                        ><a class="pointerClass" >&lt;</a></li>
                        <li 
                            v-for="n in pagination.last_page" 
                            :key="n"
                            :class="{ active: n == pagination.current_page }"
                            @click.prevent="fetchProduct(pagination.path+n)"    
                        ><span class="pointerClass">{{ n }}</span></li>
                        <li
                            :class="{ disabled: !pagination.next_page_url }"
                            @click.prevent="fetchProduct(pagination.next_page_url)"
                            ><a class="pointerClass">&gt;</a>
                        </li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-md-3 order-1 mb-5 mb-md-0">
                <div class="border p-4 rounded mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
                <ul class="list-unstyled mb-0">
                    <li class="mb-1"><a href="#" class="d-flex"><span>Men</span> <span class="text-black ml-auto">(2,220)</span></a></li>
                    <li class="mb-1"><a href="#" class="d-flex"><span>Women</span> <span class="text-black ml-auto">(2,550)</span></a></li>
                    <li class="mb-1"><a href="#" class="d-flex"><span>Children</span> <span class="text-black ml-auto">(2,124)</span></a></li>
                </ul>
                </div>

                <div class="border p-4 rounded mb-4">
                <div class="mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                    <div id="slider-range" class="border-primary"></div>
                    <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
                </div>

                <div class="mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>
                    <label for="s_sm" class="d-flex">
                    <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span class="text-black">Small (2,319)</span>
                    </label>
                    <label for="s_md" class="d-flex">
                    <input type="checkbox" id="s_md" class="mr-2 mt-1"> <span class="text-black">Medium (1,282)</span>
                    </label>
                    <label for="s_lg" class="d-flex">
                    <input type="checkbox" id="s_lg" class="mr-2 mt-1"> <span class="text-black">Large (1,392)</span>
                    </label>
                </div>

                <div class="mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Color</h3>
                    <a href="#" class="d-flex color-item align-items-center" >
                    <span class="bg-danger color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Red (2,429)</span>
                    </a>
                    <a href="#" class="d-flex color-item align-items-center" >
                    <span class="bg-success color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Green (2,298)</span>
                    </a>
                    <a href="#" class="d-flex color-item align-items-center" >
                    <span class="bg-info color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Blue (1,075)</span>
                    </a>
                    <a href="#" class="d-flex color-item align-items-center" >
                    <span class="bg-primary color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Purple (1,075)</span>
                    </a>
                </div>

                </div>
            </div>
            </div>

            <div class="row">
            <div class="col-md-12">
                <div class="site-section site-blocks-2">
                    <div class="row justify-content-center text-center mb-5">
                    <div class="col-md-7 site-section-heading pt-4">
                        <h2>Categories</h2>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                        <a class="block-2-item" href="#">
                        <figure class="image">
                            <img src="images/women.jpg" alt="" class="img-fluid">
                        </figure>
                        <div class="text">
                            <span class="text-uppercase">Collections</span>
                            <h3>Women</h3>
                        </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100">
                        <a class="block-2-item" href="#">
                        <figure class="image">
                            <img src="images/children.jpg" alt="" class="img-fluid">
                        </figure>
                        <div class="text">
                            <span class="text-uppercase">Collections</span>
                            <h3>Children</h3>
                        </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
                        <a class="block-2-item" href="#">
                        <figure class="image">
                            <img src="images/men.jpg" alt="" class="img-fluid">
                        </figure>
                        <div class="text">
                            <span class="text-uppercase">Collections</span>
                            <h3>Men</h3>
                        </div>
                        </a>
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
import Footer from './layout/Footer.vue';
import Navbar from './layout/Navbar.vue';

import axios from 'axios';

export default {
    data() {
        return {
            products : [],
            admin: localStorage.getItem('admin'),
            pagination: {}
        }
    },
    created() {
        this.fetchProduct()
    },
    components: {
        'app-navbar' : Navbar,
        'app-footer' : Footer
    },
    methods: {
        fetchProduct(url) {
            let page_url = url || '/api/product'

            axios.get(page_url)
                .then(response => {
                    // console.log(response);
                    this.products = response.data.data.data;
                    console.log(response.data.data)

                    this.pagination = {
                        'current_page' : response.data.data.current_page,
                        'last_page' : response.data.data.last_page,
                        'from_page' : response.data.data.from,
                        'to_page' : response.data.data.to,
                        'total_page' : response.data.data.total,
                        'path' : response.data.data.path + '?page=',
                        'first_page_url' : response.data.data.first_page_url,
                        'last_page_url' : response.data.data.last_page_url,
                        'prev_page_url' : response.data.data.prev_page_url,
                        'next_page_url' : response.data.data.next_page_url
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        latest() {
            axios.get('/api/product/latest')
                .then(response => {
                    // console.log(response)
                    this.products = response.data.data;
                })
                .catch(error => {
                    console.log(error)
                })
        },
        deleteProduct(id, index) {
            axios.delete('/api/product/' + id)
                .then(response => {
                    // console.log(response)
                    this.products.splice(index, 1)
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>

<style scoped>
    .pointerClass {
        cursor: pointer;
    }
</style>