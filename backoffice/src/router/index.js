import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: () => import(/* webpackChunkName: "login" */ '../views/Login.vue')
  },

  {
    path: '/',
    name: 'Dashboard',
    component: () => import(/* webpackChunkName: "login" */ '../views/Dashboard.vue')
  },

  {
    path: '/projects',
    name: 'Projects',
    component: () => import(/* webpackChunkName: "login" */ '../views/Projects.vue')
  }

]

const router = new VueRouter({
  routes
})

export default router
