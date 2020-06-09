import { createBreadcrumbs } from '@/components/nav/breadcrumbs/Breadcrumbs.js'

export const BreadcrumbsModule = () => {
  return {
    namespaced: true,
    state () {
      return {
        breadcrumbs: false
      }
    },
    mutations: {
      SET_BREADCRUMBS (state, payload) {
        state.breadcrumbs = createBreadcrumbs(payload)
      },
      RESET_BREADCRUMBS (state, payload) {
        state.breadcrumbs = false
      }
    }
  }
}
