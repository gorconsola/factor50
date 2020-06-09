<template>
  <div
    class="nav-toggle-arrow"
    :class="{'is-open': menuOpen}"
    @click="toggleMenu"
  >
    <i class="mdi arrow-right" />
  </div>
</template>

<script>
export default {
  name: 'NavToggleArrow',
  props: {
    color: {
      default: ''
    },
    location: {
      default: ''
    }
  },
  computed: {
    menuOpen () {
      return this.$store.state.menu.open
    }
  },
  methods: {
    toggleMenu () {
      return this.$store.commit('menu/TOGGLE_MENU')
    }
  }
}
</script>

<style lang="scss" scoped>
@import '@/assets/scss/buefy-config.scss';

.nav-toggle-arrow {
  width: 1.5em;
  height: 1.5em;
  border-radius: 50%;
  box-shadow: $primary-box-shadow;
  background-color: $white;
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  i {
    color: $grey;
    transition: 125ms transform;
  }

  &.is-open {
    i {
      transform: rotate(180deg);
    }
  }
}
</style>
