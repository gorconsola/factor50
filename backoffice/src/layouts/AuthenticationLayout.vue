<template>
  <div class="authentication">
    <section class="layout">

      <header class="section">
          <h1 class="title is-1">Factor50</h1>
          <h3 class="subtitle is-3">{{ title }}</h3>
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
export default {
  name: 'AuthenticationLayout',
  props: {
    title: {
      type: String,
      required: true
    }
  },
  methods: {
    login () {
      console.log('clicked')
    }
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

    h1 {
      color: tomato;
    }
  }
</style>
