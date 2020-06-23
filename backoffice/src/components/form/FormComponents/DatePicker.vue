<template>
  <div
    class="form-field column"
    :class="classes"
  >
    <b-field :label="label">

      <b-datepicker
        :value="value" 
        :type="type"
        :inline="inline"
        :rounded="rounded"
        :unselectable-days-of-week="[0, 6]"
        @input="handleInput" />

    </b-field>
  </div>
</template>

<script>
import formFieldMixin from '@/mixins/formFieldMixin'

export default {
  name: 'DatePicker',
  inject: ['$validator'],
  mixins: [formFieldMixin],
  props: [
    'value',
    'name',
    'label',
    'type',
    'placeholder',
    'reference',
    'inline',
    'rules',
    'rounded',
    'classes'
  ],
  methods: {
    handleInput (value) {
      this.$emit('input', value)
    }
  }
}
</script>

<style lang="scss" scoped>

</style>