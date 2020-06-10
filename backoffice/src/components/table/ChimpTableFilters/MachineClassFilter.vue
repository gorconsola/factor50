<template>
  <min-max-filter
    :name="name"
    :value="value"
    @input="value => $emit('input', value)"
    @submit="$emit('submit')"
  />
</template>

<script>
import MinMaxFilter from '@/components/table/ChimpTableFilters/MinMaxFilter.vue'
export default {
  name: 'MachineClassFilter',
  components: { MinMaxFilter },
  props: {
    name: {
      type: String,
      required: true
    },
    value: {
      type: String,
      required: true
    }
  }
}
</script>
