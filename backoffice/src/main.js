import Vue from 'vue'
import Buefy from 'buefy'
import VeeValidate from 'vee-validate'

import App from './App.vue'
import router from './router'
import store from './store'

import './filters'

Vue.use(Buefy, {
  defaultToastPosition: 'is-top',
  defaultToastDuration: '3500'
})

Vue.config.productionTip = false
Vue.prototype.$filters = Vue.options.filters

Vue.use(VeeValidate, {
  events: ''
})

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
