<template>
  <div class="authentication">
    <div class="columns is=mobile no-margin">
      <div class="column is-half is-offset-one-quarter">
        <section class="section section--black">
          <h1>SPF50</h1>

          <slot name="header">
            <h3>{{ title }}</h3>
          </slot>

        </section>
      </div>
    </div>
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
  }
}
</script>

<style lang="scss" scoped>

</style>
