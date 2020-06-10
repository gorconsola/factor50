<template>
  <td :data-label="label">
    <slot />
  </td>
</template>

<script>
export default {
  name: 'CustomTableRow',
  props: {
    label: {
      type: String,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
