<template>
  <form
    @submit.prevent="validateBeforeSubmit"
    @updateForm="handleInput"
    :class="{ 'horizontal-form': horizontal }"
  >
    <slot />
    <slot name="buttons" />
  </form>
</template>

<script>
export default {
  name: 'FormWrapper',
  props: {
    horizontal: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    validateBeforeSubmit () {
      this.$validator.validateAll().then((result) => {
        if (result) {
          return this.$emit('submit', result)
        }

        this.$buefy.toast.open({
          message: 'Je hebt niet alles goed ingevuld!',
          type: 'is-danger'
        })
      })
    },
    extendValidatorWithCustomRules () {
      this.$validator.extend('string', value => true)
      this.$validator.extend('number', value => true)
      this.$validator.extend('nullable', value => true)
    },
    handleInput (formData) {
      this.$emit('input', formData)
    }
  },
  mounted () {
    this.extendValidatorWithCustomRules()
  }
}
</script>

<style lang="scss" scoped>
</style>
