<template>
  <select-field
    :name="name"
    :value="value"
    :options="options"
    @input="handleInput"
  />
</template>

<script>
import SelectField from '@/components/form/FormComponents/SelectField.vue'
import tableFilterMixin from '@/components/table/ChimpTableFilters/TableFilterMixin.js'

export default {
  name: 'BooleanFilter',
  components: { SelectField },
  mixins: [tableFilterMixin],
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
  },
  methods: {
    handleInput (value) {
      this.$emit('input', value)
      this.$emit('submit')
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
