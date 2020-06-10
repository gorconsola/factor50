<template>
    <nav
      id="navbar-main"
      class="navbar is-fixed-top"
      :class="{'menu-open': menuOpen}"
    >
      <aside-header class="is-hidden-mobile" />
      <div class="navbar-menu">
        <div class="navbar-end">
          <div class="navbar-item">
            <user-component />
          </div>
        </div>
      </div>
    </nav>
</template>

<script>
import AsideHeader from '@/components/nav/aside/AsideHeader.vue'
import UserComponent from '@/components/user/UserComponent.vue'

export default {
  name: 'Navbar',
  components: {
    AsideHeader,
    UserComponent
  },
  props: {
    secondary: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    menuOpen () {
      return this.$store.state.menu.open
    }
  }
}
</script>

<style lang="scss" scoped>
@import "@/assets/scss/buefy-config.scss";

.navbar {
  height: 3.5rem;
  -webkit-box-shadow: 0px 10px 34px -18px rgba(0,0,0,0.07);
  -moz-box-shadow: 0px 10px 34px -18px rgba(0,0,0,0.07);
  box-shadow: 0px 10px 34px -18px rgba(0,0,0,0.07);
  transition: margin-left 250ms ease-out, transform 250ms ease-out;
}
</style>
