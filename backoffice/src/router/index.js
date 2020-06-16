import Vue from 'vue'
import VueRouter from 'vue-router'
import { authenticationGuard } from '@/router/routerGuards'

import projectRoutes from '@/router/projectRoutes'

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
    component: () => import(/* webpackChunkName: "login" */ '../views/Dashboard.vue'),
    beforeEnter: (to, from, next) => authenticationGuard(to, from, next)
  },
  ...projectRoutes

]

const router = new VueRouter({
  routes
})

export default router
