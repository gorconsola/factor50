import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: () => import(/* webpackChunkName: "login" */ '../views/auth/Login.vue')
  },

  {
    path: '/forgot-password',
    name: 'ForgotPassword',
    component: () => import(/* webpackChunkName: "login" */ '../views/auth/ForgotPassword.vue')
  },

  {
    path: '/dashboard',
    name: 'dashboard',
    component: () => import(/* webpackChunkName: "login" */ '../views/Dashboard.vue')
  },

  {
    path: '/projects',
    name: 'projects',
    component: () => import(/* webpackChunkName: "login" */ '../views/Projects.vue')
  }

]

const router = new VueRouter({
  routes
})

export default router
