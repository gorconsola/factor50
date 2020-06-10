const BREAKPOINTS = {
  mobile: 768
}

export const WindowModule = () => {
  return {
    namespaced: true,
    state () {
      return {
        isMobile: false
      }
    },
    mutations: {
      SET_IS_MOBILE (state, payload) {
        state.isMobile = payload
      }
    },
    actions: {
      handleWindowResize ({ commit, state }, window) {
        commit('SET_IS_MOBILE', (window.innerWidth <= BREAKPOINTS.mobile))

        if (state.isMobile) {
          commit('menu/CLOSE_MENU', null, { root: true })
        }
      }
    }
  }
}
