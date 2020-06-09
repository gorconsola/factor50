<template>
  <div class="form-elements columns">

    <component
      :is="field.fieldType"
      v-for="(field, index) in schema"
      :key="index"
      :value="formData[field.name]"
      :rules="field.rules"
      :options="field.options"
      v-bind="field"
      @input="updateForm(field.name, $event)" />

  </div>
</template>

<script>
import FormComponents from './FormComponents'

export default {
  name: 'FormGenerator',
  inject: ['$validator'],
  components: FormComponents,
  props: ['value', 'schema'],
  data () {
    return {
      formData: this.value || {}
    }
  },
  watch: {
    value: {
      handler (val) {
        this.formData = { ...this.formData, ...val }
      },
      deep: true
    }
  },
  methods: {
    updateForm (fieldName, value) {
      this.$set(this.formData, fieldName, value)
      this.$emit('input', this.formData)
      this.$emit('update:value', this.formData)
    }
  }
}
</script>
