<template>
  <h4 :class="classes" class="divider">{{ title }}</h4>
</template>

<script>
export default {
  name: 'Divider',
  props: {
    title: {
      type: String,
      required: true
    },
    classes: {
      type: String,
      default: 'column is-full card-header-title is-size-4 is-secondary'
    }
  }
}
</script>

<style lang="scss" scoped>
  .divider {
    margin-bottom: 0;
    margin-top: 0.8em;
  }
</style>
