<template>
  <error-wrapper @error="handleError">
    <div id="app">
      <router-view/>
    </div>
  </error-wrapper>
</template>

<script>
import ErrorWrapper from '@/components/errors/ErrorWrapper.js'

export default {
  name: 'App',
  components: {
    ErrorWrapper
  },
  computed: {
    isAuthenticated () {
      return this.$store.getters['authentication/isAuthenticated']
    },
    hasUser () {
      return !!this.$store.state.authentication.user.role
    }
  },
  created () {
    window.addEventListener('resize', this.setWindowSize)
  },
  beforeDestroy () {
    window.removeEventListener('resize', this.setWindowSize)
  },
  mounted () {
    if (this.isAuthenticated && !this.hasUser) {
      this.$store.dispatch('authentication/getUser')
    }

    this.setWindowSize()
  },
  methods: {
    setWindowSize () {
      this.$store.dispatch('window/handleWindowResize', window)
    },
    handleError (error) {
      this.$buefy.toast.open({
        message: error.message || error.data.message,
        type: 'is-danger'
      })
    }
  }
}
</script>

<style lang="scss">
  @import '~@/assets/scss/global.scss';
  @import '~@/assets/scss/buefy-config.scss';
</style>
