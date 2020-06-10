<template>
  <div class="authentication">
    <section class="layout">

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
  }
}
</script>

<style lang="scss" scoped>
  .authentication {
    height: 100vh;
  }

  .layout {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    text-align: center;
    background: #f6f8f9;  /* fallback for old browsers */
    background-image: linear-gradient(73deg, rgba(255, 255, 255, 0) 30%, rgba(255, 255, 255, 1));

    h1 {
      color: tomato;
    }
  }
</style>
