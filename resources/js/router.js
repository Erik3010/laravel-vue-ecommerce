import Vue from 'vue';
import VueRouter from 'vue-router';

// components
import Login from './components/auth/Login'
import Register from './components/auth/Register'
import Shop from './components/Shop.vue'
import ShopSingle from './components/ShopSingle.vue'
import Cart from './components/Cart.vue'
import Checkout from './components/Checkout.vue'
import Thank from './components/Thank.vue'

// admin component
import ProductCreate from './components/admin/ProductCreate.vue'
import ProductEdit from './components/admin/ProductEdit.vue'

Vue.use(VueRouter);

const routes = [
    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        component: Register
    },
    {
        path: '/',
        component: Shop,
        meta: { requiresAuth: true }
    },
    {
        path: '/single/:id',
        component: ShopSingle,
        name: 'single',
        meta: { requiresAuth: true }
    },
    {
        path: '/cart',
        component: Cart,
        meta: { requiresAuth: true }
    },
    {
        path: '/checkout',
        component: Checkout,
        meta: { requiresAuth: true }
    },
    {
        path: '/thank',
        component: Thank,
        meta: { requiresAuth: true }
    },
    {
        path: '/create',
        component: ProductCreate,
        meta: {
            requiresAuth: true,
            is_admin: true
        }
    },
    {
        path: '/edit/:id',
        component: ProductEdit,
        name: 'edit',
        meta: {
            requiresAuth: true,
            is_admin: true
        }
    }
]

const router = new VueRouter({
    routes,
    mode: 'history'
})

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if(!localStorage.getItem('token')) {
            next('/login')
        } else {
            let admin = localStorage.getItem('admin');
            if(to.matched.some(record => record.meta.is_admin)) {
                if(admin == 1) {
                    next()
                } else {
                    next('/')
                }
            } else {
                next();
            }
        }
    } else {
        next();
    }
});

export default router;