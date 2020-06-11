<template>
  <div class="authentication">
    <section class="layout" :class="{ 'isMobile': isMobile }">

      <header class="section">
        <logo />
        <h3 class="subtitle is-5">{{ title }}</h3>
      </header>

      <section class="section form-section">
        <slot name="form">
          <h1>PUT YOUR FORM HERE...</h1>
        </slot>
      </section>

    </section>
  </div>
</template>

<script>
import Logo from '@/components/logo/Logo.vue'

export default {
  name: 'AuthenticationLayout',
  props: {
    title: {
      type: String,
      required: true
    }
  },
  components: {
    Logo
  },
  computed: {
    isMobile () {
      return this.$store.state.window.isMobile
    }
  }
}
</script>

<style lang="scss" scoped>
  .authentication {
    height: 100vh;
    background: #f6f8f9;  /* fallback for old browsers */
    background-image: linear-gradient(73deg, rgba(255, 255, 255, 0) 30%, rgba(255, 255, 255, 1));
  }

  .layout {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    height: 100%;
    max-height: 600px;
    text-align: center;

    &.isMobile {
      max-height: 100%;
    }

    h1 {
      color: tomato;
    }

    .form-section {
      width: 100%;
      max-width: 500px
    }
  }
</style>
