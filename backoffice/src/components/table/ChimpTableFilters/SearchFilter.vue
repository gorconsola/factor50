<template>
  <input-field
    :name="name"
    :value="value"
    placeholder="Search"
    @input="handleInput"
    @blur="handleBlur"
  />
</template>

<script>
import InputField from '@/components/form/FormComponents/InputField.vue'
import tableFilterMixin from '@/components/table/ChimpTableFilters/TableFilterMixin.js'
import queryStringMixin from '@/components/http/QueryStringMixin.js'

export default {
  name: 'SearchFilter',
  components: { InputField },
  mixins: [tableFilterMixin, queryStringMixin],
  props: {
    name: {
      type: String,
      required: true
    },
    value: {
      type: String,
      required: true
    }
  },
  methods: {
    handleInput (value) {
      this.toggleHasChanged(true)
      this.updateQueryString(this.name, value)
      this.$emit('input', value)
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
