<template>
  <component
    :is="tag"
    :value="value"
    v-bind="filter"
    @input="handleInput"
    @submit="$emit('submit')"
  />
</template>

<script>
import SearchFilter from '@/components/table/ChimpTableFilters/SearchFilter.vue'
import OptionsFilter from '@/components/table/ChimpTableFilters/OptionsFilter.vue'
import EnumFilter from '@/components/table/ChimpTableFilters/EnumFilter.vue'
import MinMaxFilter from '@/components/table/ChimpTableFilters/MinMaxFilter.vue'
import MachineClassFilter from '@/components/table/ChimpTableFilters/MachineClassFilter.vue'
import BooleanFilter from '@/components/table/ChimpTableFilters/BooleanFilter.vue'

export default {
  name: 'FilterGenerator',
  components: {
    SearchFilter,
    OptionsFilter,
    EnumFilter,
    MinMaxFilter,
    MachineClassFilter,
    BooleanFilter
  },
  props: {
    value: {
      type: String,
      required: true
    },
    tag: {
      type: String,
      required: true
    },
    filter: {
      type: Object,
      required: true
    }
  },
  methods: {
    handleInput (value) {
      this.$emit('input', value)
    }
  }

}
</script>

<style lang="scss" scoped>

</style>
