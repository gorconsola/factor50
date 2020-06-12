<template>
  <card>

    <b-loading
      v-if="showLoader"
      :is-full-page="false"
      :active.sync="loading" />

    <template #header>
      <slot name="header">
        {{ title }}
      </slot>
    </template>

    <template>
      <form-wrapper
        ref="formWrapper"
        @submit="handleSubmit"
      >
        <slot :updateForm="updateForm">

          <form-generator
            ref="formGenerator"
            :value="formData"
            @input="updateForm"
            :schema="schema" />

        </slot>

        <template v-slot:buttons v-if="!hideButtons">
          <slot name="buttons" :hasChanges="hasChanges" :loading="loading">
            <div class="buttons-container">
              <b-button
                type="is-primary"
                native-type="submit"
                :loading="loading"
                :disabled="!hasChanges"
              >
                Save
              </b-button>
            </div>
          </slot>
        </template>
      </form-wrapper>
    </template>
  </card>
</template>

<script>
import Card from '@/components/ui/Card.vue'
import FormWrapper from '@/components/form/FormWrapper.vue'
import FormGenerator from '@/components/form/FormGenerator.vue'

export default {
  name: 'FormCard',
  components: {
    Card,
    FormWrapper,
    FormGenerator
  },
  props: {
    title: {
      type: String,
      default: 'Form'
    },
    formData: {
      type: Object,
      default: () => {}
    },
    schema: {
      type: Array,
      default: () => []
    },
    loading: {
      type: Boolean,
      default: false
    },
    showLoader: {
      type: Boolean,
      default: false
    },
    hideButtons: {
      type: Boolean,
      default: false
    }
  },
  data () {
    return {
      hasChanges: false
    }
  },
  methods: {
    updateForm (formData) {
      this.hasChanges = true
      this.$emit('update:formData', formData)
    },
    handleSubmit () {
      this.$emit('submit', this.formData)
      this.hasChanges = false
    }
  }
}
</script>
