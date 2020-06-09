import Vue from 'vue'
import Vuex from 'vuex'

import { AuthenticationModule } from '@/store/AuthenticationModule.js'
import { MenuModule } from '@/store/MenuModule'
import { WindowModule } from '@/store/WindowModule'
import { BreadcrumbsModule } from '@/components/nav/breadcrumbs/BreadcrumbsModule'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    authentication: AuthenticationModule(),
    menu: MenuModule(),
    window: WindowModule(),
    breadcrumbs: BreadcrumbsModule()
  }
})
