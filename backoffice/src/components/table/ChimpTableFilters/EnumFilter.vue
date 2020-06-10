<template>
  <options-filter
    :name="name"
    :value="value"
    :options="options"
    @input="value => $emit('input', value)"
    @submit="$emit('submit')"
  />
</template>

<script>
import OptionsFilter from '@/components/table/ChimpTableFilters/OptionsFilter.vue'
export default {
  name: 'EnumFilter',
  components: { OptionsFilter },
  props: {
    name: {
      type: String,
      required: true
    },
    value: {
      type: String,
      required: true
    },
    options: {
      type: Array,
      required: true
    }
  }
}
</script>

<style lang="css" scoped>
</style>
