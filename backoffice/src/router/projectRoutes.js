// import { createBreadcrumb } from '@/components/nav/breadcrumbs/Breadcrumbs.js'
import { authenticationGuard } from '@/router/routerGuards'

export default [
  {
    path: '/projects',
    name: 'projects',
    component: () => import(/* webpackChunkName: "projects" */ '../views/projects/Projects.vue'),
    beforeEnter: (to, from, next) => authenticationGuard(to, from, next)
  },

  {
    path: '/projects/new',
    name: 'create-project',
    component: () => import(/* webpackChunkName: "new-project" */ '../views/projects/CreateProject.vue'),
    beforeEnter: (to, from, next) => authenticationGuard(to, from, next)
  },

  {
    path: '/projects/:projectId',
    component: () => import(/* webpackChunkName: "project" */ '../views/projects/Project.vue'),
    children:
    [
      {
        path: '/',
        name: 'details',
        component: () => import(/* webpackChunkName: "project-details" */ '@/views/projects/ProjectDetails.vue'),
        beforeEnter: (to, from, next) => authenticationGuard(to, from, next)
      },

      {
        path: 'tasks',
        name: 'tasks',
        component: () => import(/* webpackChunkName: "project-tasks" */ '@/views/projects/ProjectTasks.vue'),
        beforeEnter: (to, from, next) => authenticationGuard(to, from, next)
      },

      {
        path: 'documents',
        name: 'documents',
        component: () => import(/* webpackChunkName: "project-documents" */ '@/views/projects/ProjectDocuments.vue'),
        beforeEnter: (to, from, next) => authenticationGuard(to, from, next)
      },

      {
        path: 'publishing',
        name: 'publishing',
        component: () => import(/* webpackChunkName: "project-documents" */ '@/views/projects/ProjectPublishing.vue'),
        beforeEnter: (to, from, next) => authenticationGuard(to, from, next)
      }
    ]
  }
]
