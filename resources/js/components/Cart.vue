<template>
    <div>
        <app-navbar></app-navbar>

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row mb-5">
                    <form class="col-md-12" method="post">
                        <div class="site-blocks-table">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-total">Total</th>
                                        <th class="product-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(cart, index) in carts" :key="cart.cartsId">
                                        <td class="product-thumbnail">
                                            <img :src="'./images/' + cart.picture " alt="Image" class="img-fluid">
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ cart.name }}</h2>
                                        </td>
                                        <td>${{ cart.price }}</td>
                                        <td>
                                            <div class="input-group mb-3" style="max-width: 120px;">
                                                <div class="input-group-prepend">
                                                <button 
                                                    class="btn btn-outline-primary js-btn-minus" 
                                                    type="button"
                                                    @click.prevent="minusAmount(cart.cartsId, cart.product_id, cart.quantity, cart.price)"
                                                >&minus;</button>
                                                </div>
                                                <input 
                                                    type="text" 
                                                    class="form-control text-center"
                                                    :value="cart.quantity" 
                                                    placeholder="" 
                                                    aria-label="Example text with button addon" 
                                                    aria-describedby="button-addon1"
                                                >
                                                <div class="input-group-append">
                                                <button 
                                                    class="btn btn-outline-primary js-btn-plus" 
                                                    type="button"
                                                    @click.prevent="plusAmount(cart.cartsId, cart.product_id, cart.quantity, cart.price)"
                                                >&plus;</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>${{ formatPrice(cart.total) }}</td>
                                        <td>
                                            <button 
                                                class="btn btn-primary btn-sm"
                                                @click.prevent="remove(cart.productId, index)"    
                                            >X</button>
                                        </td>
                                    </tr>  
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <button class="btn btn-primary btn-sm btn-block">Update Cart</button>
                            </div>
                            <div class="col-md-6">
                                <router-link to="/">
                                    <a class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</a>
                                </router-link>
                                <!-- <button class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</button> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-black h4" for="coupon">Coupon</label>
                                <p>Enter your coupon code if you have one.</p>
                            </div>
                            <div class="col-md-8 mb-3 mb-md-0">
                                <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-sm">Apply Coupon</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                            <div class="col-md-12 text-right border-bottom mb-5">
                                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-6">
                                <span class="text-black">Subtotal</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black">${{ formatPrice(total) }}</strong>
                            </div>
                            </div>
                            <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black">${{ formatPrice(total) }}</strong>
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-md-12">
                                <button 
                                    class="btn btn-primary btn-lg py-3 btn-block" 
                                    @click.prevent="checkout()"
                                >Proceed To Checkout</button>
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

import axios from 'axios'

export default {
    data() {
        return {
            token: localStorage.getItem('token'),
            carts: [],
            total: {}
        }
    },
    components: {
        'app-navbar': Navbar,
        'app-footer': Footer
    },
    created() {
        this.fetchCart();
        this.fetchTotal();
    },
    methods: {
        fetchCart() {
            axios.get('/api/cart/' + this.token)
                .then(response => {
                    this.carts = response.data.data;
                    // console.log(this.carts)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        remove(productId, index) {
            axios.delete('/api/cart/' + productId)
                .then(response => {
                    // console.log(response)
                    this.carts.splice(index, 1)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        formatPrice(value) {
            return (value/1).toFixed(2);
        },
        totalPrice(quantity, price) {
            let total = parseInt(quantity) * parseInt(price);
            return (total/1).toFixed(2)
        },
        minusAmount(cartId, productId, quantity, price) {
            axios.post('/api/cart/minAmount', {'cartId': cartId, 'productId': productId, 'quantity': quantity, 'price': price})
                .then(response => {
                    this.fetchCart();
                    this.fetchTotal();
                    // console.log(response)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        plusAmount(cartId, productId, quantity, price) {
            axios.post('/api/cart/plusAmount', {'cartId': cartId, 'productId': productId, 'quantity': quantity, 'price': price})
                .then(response => {
                    this.fetchCart();
                    this.fetchTotal();
                    // console.log(response)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        fetchTotal() {
            axios.get('/api/cart/price/' + this.token)
                .then(response => {
                    // console.log(response)
                    this.total = response.data.total;
                    // console.log(this.total);
                })
                .catch(error => {
                    console.log(error)
                })
        },
        checkout() {
            this.$router.push('/checkout')
        }
    }
}
</script>