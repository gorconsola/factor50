import HttpBaseService from './http/HttpBaseService'
import store from '@/store/index.js'

class AccountService extends HttpBaseService {
  login = (payload) => {
    this.secure = false

    return this.executeRequest('/auth/login', 'POST',
      {
        email: payload.email,
        password: payload.password
      })
      .then(response => {
        this.saveAuthToken(response.data.token)
        store.commit('authentication/SET_TOKEN', response.data.token)
        store.commit('authentication/SET_USER', response.data.user)

        return response
      })
  }

  logout = () => {
    this.secure = true

    return this.executeRequest('/auth/logout', 'POST')
      .finally(response => {
        store.commit('authentication/SET_TOKEN', '')
        store.commit('authentication/RESET_USER')

        this.deleteAuthToken()
        return response
      })
  }

  requestPasswordResetLink = ({ email }) => {
    this.secure = false

    return this.executeRequest(`/auth/forgot-password?email=${btoa(email)}`, 'GET')
  }

  resetPassword = (payload) => {
    this.secure = false
    return this.executeRequest('/auth/password/reset', 'POST', payload)
  }

  getUser = () => {
    this.secure = true

    return this.executeRequest('/auth/me', 'GET')
  }
}

export default new AccountService()
