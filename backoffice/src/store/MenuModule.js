export const MenuModule = () => {
  return {
    namespaced: true,
    state () {
      return {
        open: true
      }
    },
    mutations: {
      OPEN_MENU (state) {
        state.open = true
      },
      CLOSE_MENU (state) {
        state.open = false
      },
      TOGGLE_MENU (state) {
        state.open = !state.open
      }
    }
  }
}
