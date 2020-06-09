<template>
  <button
    class="nav-toggle"
    :class="[color, `toggle-${location}`]"
    @click="toggleMenu"
  >
    <div class="nav-toggle__inner">
      <span />
      <span />
      <span />
    </div>
  </button>
</template>

<script>
export default {
  name: 'NavToggle',
  props: {
    color: {
      default: ''
    },
    location: {
      default: ''
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
.nav-toggle {
  width: 3.5rem;
  height: 3.5rem;
  position: relative;
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: transparent;
  border: 0;
  cursor: pointer;
  position: absolute !important;
  top: 0;

  &:focus {
    outline: none;
  }

  &__inner {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 20px;
    height: 15px;
    opacity: .5;
    &:hover {
      &__inner {
        opacity: 1;
      }
    }
  }

  span {
    display: block;
    position: absolute;
    width: 20px;
    height: 1px;
    background-color: #fff;;

    &:nth-child(1) {
      top: 0px;
    }

    &:nth-child(2) {
      top: 6px;
    }

    &:nth-child(3) {
      top: 12px;
    }
  }

  &.white {
    span {
      background-color: white;
    }
  }

  &.toggle-aside {
    position: absolute;
    right: 5px;
    // height: 52px;
    transform: none;
  }
}
</style>
