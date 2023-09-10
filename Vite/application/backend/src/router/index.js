import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import AppLayout from '../views/AppLayout.vue'
import PasswordRequest from '../views/PasswordRequest.vue'
import PasswordReset from '../views/PasswordReset.vue'
import Dashboard from '../components/Dashboard.vue'
import Users from '../components/Users.vue'
import Products from '../components/products/Products.vue'
import Reports from '../components/Reports.vue'
import NotFound from '../views/NotFound.vue'
import store from '../store'

const routes = [
    {
        path: '/app',
        name: 'app',
        component: AppLayout,
        meta: {
            RequiresAuth: true
        },
        children: [
            {
                path: 'dashboard',
                name: 'app.dashboard',
                component: Dashboard
            },
            {
                path: 'users',
                name: 'app.users',
                component: Users
            },
            {
                path: 'products',
                name: 'app.products',
                component: Products
            },
            {
                path: 'reports',
                name: 'app.reports',
                component: Reports
            },

        ]
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            RequiresGuest: true
        }
    },
    {
        path: '/reset-password/:token',
        name: 'reset-password',
        component: PasswordReset,
        meta: {
            RequiresGuest: true
        }
    },
    {
        path: '/request-password',
        name: 'request-password',
        component: PasswordRequest,
        meta: {
            RequiresGuest: true
        }
    },
    {
        path: '/:pathMatch(.*)',
        name: 'not-found',
        component: NotFound,
        meta: {
            RequiresGuest: true
        }
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.RequiresAuth && !store.state.user.token) {
        next({ name: 'login' })
    } else if (to.meta.RequiresGuest && store.state.user.token) {
        next({ name: 'app.dashboard' })
    } else {
        next()
    }
})

export default router
