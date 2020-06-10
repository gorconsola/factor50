<template>
  <aside
    class="aside"
    :class="[{ 'menu-open': menuOpen }, type]"
  >
    <menu-generator :schema="menuSchema" />
    <menu-generator
      v-if="type !== 'secondary'"
      class="margin-auto"
      :schema="footerSchema"
    />
  </aside>
</template>

<script>
import footerSchema from '@/helpers/schemas/footerSchema.js'
import MenuGenerator from '@/components/nav/aside/MenuGenerator'

export default {
  name: 'Aside',
  components: {
    MenuGenerator
  },
  props: {
    menuSchema: {
      type: Array,
      required: true
    },
    closable: {
      type: Boolean,
      default: true
    },
    type: {
      type: String,
      default: 'primary',
      validator: function (value) {
        return ['primary', 'secondary'].indexOf(value) !== -1
      }
    }
  },
  data () {
    return {
      footerSchema: footerSchema
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

::-webkit-scrollbar {
  display: none;
}

.aside {
  height: 100vh;
  width: 244px;
  flex-shrink: 0;
  position: fixed;
  top: 0;
  left: 0;
  background-color: #2d3747;
  z-index: 3;
  transition: .5s;
  transition: transform 250ms ease-out;
  display: flex;
  flex-direction: column;
  padding-top: 3.5em;
  box-shadow: $primary-box-shadow;
  transform: translateX(calc(-100% + 24px));

  &.primary {
    z-index: 9;
  }

  &.secondary {
    background-color: $lighter-grey !important;
    left: 244px;
    padding-left: 20px;
  }

  &.menu-open {
    transform: translateX(0%);
  }
}

.aside body {
  margin-top: 3.5em;
  color: #727c8f;
}

.menu-container {
  font-size: 14px;
}

.margin-auto {
  margin-top: auto !important;
  margin-bottom: 1em;
}

.nav-toggle-arrow {
  position: absolute;
  top: 6.25em;
  left: calc(100% - 0.75em);
}
</style>
