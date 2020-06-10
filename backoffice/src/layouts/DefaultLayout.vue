<template>
  <div class="default-layout">
    <navbar :secondary="!!secondaryMenuSchema.length" />
    <side-nav :menu-schema="menuSchema" />
    <main :class="{'menu-open': menuOpen, 'fixed-width': isMobile , 'secondary-menu-active': !!secondaryMenuSchema.length }">
      <slot name="breadcrumbs">
        <bread-crumbs base-crumb="dashboard" />
      </slot>
      <slot />
    </main>
  </div>
</template>

<script>
import SideNav from '@/components/nav/aside/Aside'
import BreadCrumbs from '@/components/nav/BreadCrumbs.vue'
import Navbar from '@/components/nav/Navbar'
import menuSchema from '@/helpers/schemas/menuSchema'

export default {
  name: 'DefaultLayout',
  components: {
    SideNav,
    BreadCrumbs,
    Navbar
  },
  props: {
    secondaryMenuSchema: {
      type: Array,
      default: () => []
    }
  },
  data () {
    return {
      menuSchema
    }
  },
  computed: {
    menuOpen () {
      return this.$store.state.menu.open
    },
    isMobile () {
      return this.$store.state.window.isMobile
    }
  }
}
</script>

<style lang="scss" scoped>
.default-layout {
  min-height: 100vh;

  main {
    min-height: 100vh;
    transition: 250ms all ease-out;
    background-color: #edf2f6;
    width: 100%;
    max-width: 1200px;
    padding-top: 3rem;
    overflow: hidden;

    &.secondary-menu-active {
      margin-left: calc(244px + 24px); // safe 24px for toggle
      width: calc(100% - (244px + 24px));
    }

    &.menu-open {
      margin-left: 244px;
      width: calc(100% - 244px); // safe 24px for toggle

      &.secondary-menu-active {
        width: calc(100% - 244px * 2); // safe 24px for toggle
        margin-left: calc(244px * 2); // two menu's here!
      }
    }

    &.fixed-width {
      min-width: 100vw;
    }
  }
}
</style>
