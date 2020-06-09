<template>
  <b-field
    class="form-field"
    :class="classes"
    :message="errorMessage"
    :type="{'is-danger': errors.has(name)}"
  >
    <b-switch
      :name="name"
      :value="value"
      :type="type"
      :disabled="disabled"
      @input="value => handleInput(value)"
    >

      {{ label }}

    </b-switch>
  </b-field>
</template>

<script>
import formFieldMixin from '@/mixins/formFieldMixin'

export default {
  name: 'SwitchField',
  mixins: [formFieldMixin],
  inject: ['$validator'],
  props: {
    value: {
      required: true,
      validator: value => ['boolean', 'undefined'].indexOf(typeof value) !== -1
    },
    name: {
      type: String,
      required: true
    },
    label: {
      type: String,
      required: true
    },
    rules: {
      type: String,
      default: ''
    },
    type: {
      type: String,
      default: 'is-primary'
    },
    disabled: {
      type: Boolean,
      default: false
    },
    classes: {
      type: String,
      default: ''
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
