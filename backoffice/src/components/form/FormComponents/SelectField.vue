<template>
  <div
    class="form-field column"
    :class="classes"
  >

    <b-field
      :label="label"
      :message="errorMessage"
      :type="{'is-danger': errors.has(name)}"
      :horizontal="horizontal"
    >

      <template slot="label" v-if="label">

        <field-label
          :label="label"
          :rules="rules" />

      </template>

      <b-select
        v-validate="`${rules}`"
        :name="name"
        :value="value || null"
        :placeholder="placeholder"
        :expanded="expanded"
        @input="handleInput"
        @blur="$emit('blur')"
      >

        <option
          v-for="option in options"
          :key="option.value"
          :value="option.value"
        >

          {{ option.label }}

        </option>
      </b-select>
    </b-field>
  </div>
</template>

<script>
import formFieldMixin from '@/mixins/formFieldMixin'

export default {
  name: 'SelectField',
  inject: ['$validator'],
  mixins: [formFieldMixin],
  props: {
    value: {
      required: true
    },
    name: {
      type: String,
      required: true
    },
    label: {
      type: String,
      required: false
    },
    placeholder: {
      type: String,
      required: false
    },
    horizontal: {
      type: Boolean,
      default: false
    },
    rules: {
      type: String,
      default: ''
    },
    options: {
      type: Array,
      required: true
    },
    multiple: {
      type: Boolean,
      default: false
    },
    expanded: {
      type: Boolean,
      default: true
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
