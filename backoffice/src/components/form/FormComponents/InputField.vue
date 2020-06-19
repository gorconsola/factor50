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

      <b-input
        v-validate="`${rules}`"
        :id="reference"
        :name="name"
        :type="type"
        :value="value"
        :placeholder="placeholder"
        rounded
        @input="handleInput"
        @blur="$emit('blur')" />

    </b-field>
  </div>
</template>

<script>
import formFieldMixin from '@/mixins/formFieldMixin'

export default {
  name: 'InputField',
  inject: ['$validator'],
  mixins: [formFieldMixin],
  props: [
    'value',
    'name',
    'label',
    'type',
    'placeholder',
    'reference',
    'horizontal',
    'rules',
    'classes'
  ],
  methods: {
    handleInput (value) {
      this.$emit('input', value)
    }
  }
}
</script>
