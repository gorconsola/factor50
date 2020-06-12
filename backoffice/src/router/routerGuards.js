import store from '@/store/index.js'

export const authenticationGuard = (to, from, next) => {
  if (!isAuthenticated()) {
    return next({ name: 'login' })
  } else {
    return next()
  }
}

const isAuthenticated = () => {
  return store.getters['authentication/isAuthenticated']
}
