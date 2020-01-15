<template>
    <div>
        <app-navbar></app-navbar>

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Billing Details</h2>
                    <div class="p-3 p-lg-5 border">
                    <div class="form-group row">
                        <div class="col-md-12">
                        <label for="c_fname" class="text-black">Username <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="c_fname" 
                            name="c_fname"
                            v-model="data.user.name"    
                        >
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                        <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="c_email_address" 
                            name="c_email_address"
                            v-model="data.user.email"
                        >
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                        <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="c_address" 
                            name="c_address" 
                            placeholder="Street address"
                            v-model="data.detail.address"    
                        >
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                        <label for="c_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="c_state_country" 
                            name="c_state_country"
                            v-model="data.detail.country"
                        >
                        </div>
                        <div class="col-md-6">
                        <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                        <input 
                            type="text"
                            class="form-control" 
                            id="c_postal_zip" 
                            name="c_postal_zip"
                            v-model="data.detail.post_code"
                        >
                        </div>
                    </div>

                    <div class="form-group row mb-5">
                        <div class="col-md-12">
                        <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="c_phone" 
                            name="c_phone" 
                            placeholder="Phone Number"
                            v-model="data.detail.phone"    
                        >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="c_order_notes" class="text-black">Order Notes</label>
                        <textarea 
                            name="c_order_notes" 
                            id="c_order_notes" 
                            cols="30" 
                            rows="5" 
                            class="form-control" 
                            placeholder="Write your notes here..."
                            v-model="data.detail.order_note"    
                        ></textarea>
                    </div>

                    </div>
                </div>
                <div class="col-md-6">

                    <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                        <div class="p-3 p-lg-5 border">
                        
                        <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
                        <div class="input-group w-75">
                            <input type="text" class="form-control" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
                            <div class="input-group-append">
                            <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Apply</button>
                            </div>
                        </div>

                        </div>
                    </div>
                    </div>
                    
                    <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Your Order</h2>
                        <div class="p-3 p-lg-5 border">
                        <table class="table site-block-order-table mb-5">
                            <thead>
                            <th>Product</th>
                            <th>Total</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Top Up T-Shirt <strong class="mx-2">x</strong> 1</td>
                                <td>$250.00</td>
                            </tr>
                            <tr>
                                <td>Polo Shirt <strong class="mx-2">x</strong>   1</td>
                                <td>$100.00</td>
                            </tr>
                            <tr>
                                <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                                <td class="text-black">$350.00</td>
                            </tr>
                            <tr>
                                <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                <td class="text-black font-weight-bold"><strong>$350.00</strong></td>
                            </tr>
                            </tbody>
                        </table>

                        <h2 class="h3 mb-3 text-black">Payment Method</h2>
                        <div class="form-group">
                            <select 
                                id="c_diff_country" 
                                class="form-control"
                                v-model="data.detail.payment_method"   
                            >
                                <option value="transfer">Direct Bank Transfer</option>    
                                <option value="cheque">Cheque Payment</option>    
                                <option value="paypal">Paypal</option>     
                            </select>
                        </div>

                        <div class="border p-3 mb-3">
                            <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

                            <div class="collapse" id="collapsebank">
                            <div class="py-2">
                                <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                            </div>
                            </div>
                        </div>

                        <div class="border p-3 mb-3">
                            <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

                            <div class="collapse" id="collapsecheque">
                            <div class="py-2">
                                <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                            </div>
                            </div>
                        </div>

                        <div class="border p-3 mb-5">
                            <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

                            <div class="collapse" id="collapsepaypal">
                            <div class="py-2">
                                <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button 
                                class="btn btn-primary btn-lg py-3 btn-block"
                                @click.prevent="order"    
                            >Place Order</button>
                        </div>

                        </div>
                    </div>
                    </div>

                </div>
                </div>
                <!-- </form> -->
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
            token: localStorage.getItem('token'),
            data : {
                user: {},
                detail: {
                    address: '',
                    country: '',
                    post_code: '',
                    phone: '',
                    order_note: '',
                    payment_method: ''
                }
            }
        }
    },
    components: {
        'app-navbar': Navbar,
        'app-footer': Footer
    },
    created() {
        axios.get('/api/checkout/' + this.token)
            .then(response => {
                this.data.user = response.data.data
                console.log(this.data.user);
            })
            .catch(error => {
                console.log(error)
            })
    },
    methods: {
        order(){
            axios.post('/api/order', this.data)
                .then(response => {
                    // console.log(response.data.message)
                    if(response.data.message == "success") {
                        this.$router.push('/thank')
                    }
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>