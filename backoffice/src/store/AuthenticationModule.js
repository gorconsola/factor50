import accountService from '@/services/AccountService'

export const AuthenticationModule = () => {
  return {
    namespaced: true,
    state () {
      return {
        token: localStorage.getItem('x-auth-token') || '',
        user: {
          id: '',
          name: '',
          role: ''
        }
      }
    },
    mutations: {
      SET_USER (state, user) {
        state.user.id = user.id
        state.user.name = user.name || user.email
        state.user.role = user.user_role.slug
      },
      RESET_USER (state) {
        state.user = {
          name: '',
          role: ''
        }
      },
      SET_TOKEN (state, token) {
        state.token = token
      }
    },
    actions: {
      getUser ({ commit, state }) {
        return accountService.getUser()
          .then(response => {
            commit('SET_USER', response.data)
            return response
          })
      }
    },
    getters: {
      isAdmin: state => state.user.role === 'admin',
      isAuthenticated: state => !!state.token,
      isUserRoleSet: state => !!state.user.role
    }
  }
}
