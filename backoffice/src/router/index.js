import Vue from 'vue'
import VueRouter from 'vue-router'
import { authenticationGuard } from '@/router/routerGuards'

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

  {
    path: '/projects',
    name: 'projects',
    component: () => import(/* webpackChunkName: "login" */ '../views/projects/Projects.vue'),
    beforeEnter: (to, from, next) => authenticationGuard(to, from, next)
  },

  {
    path: '/projects/new',
    name: 'create-project',
    component: () => import(/* webpackChunkName: "login" */ '../views/projects/CreateProject.vue'),
    beforeEnter: (to, from, next) => authenticationGuard(to, from, next)
  },

  {
    path: '/projects/:id',
    name: 'project',
    component: () => import(/* webpackChunkName: "login" */ '../views/projects/ProjectDetail.vue'),
    beforeEnter: (to, from, next) => authenticationGuard(to, from, next)
  }

]

const router = new VueRouter({
  routes
})

export default router
