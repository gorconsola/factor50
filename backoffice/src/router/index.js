import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/login',
    name: 'login',
    component: () => import(/* webpackChunkName: "login" */ '../views/auth/Login.vue')
  },

  {
    path: '/forgot-password',
    name: 'forgot-password',
    component: () => import(/* webpackChunkName: "login" */ '../views/auth/ForgotPassword.vue')
  },

  {
    path: '/',
    name: 'dashboard',
    component: () => import(/* webpackChunkName: "login" */ '../views/Dashboard.vue')
  },

  {
    path: '/projects',
    name: 'projects',
    component: () => import(/* webpackChunkName: "login" */ '../views/projects/Projects.vue')
  },

  {
    path: '/projects/new',
    name: 'create-project',
    component: () => import(/* webpackChunkName: "login" */ '../views/projects/CreateProject.vue')
  }

]

const router = new VueRouter({
  routes
})

export default router
