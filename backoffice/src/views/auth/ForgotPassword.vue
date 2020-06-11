<template>
  <authentication-layout title="Forgot Password">
    <template v-slot:form>
      <api-wrapper
        endpoint="accountService.requestPasswordResetLink"
        @success="handleRouting"
      >
        <form-wrapper
          slot-scope="{ loading, sendRequest }"
          @submit="sendRequest(formData)"
        >

          <form-generator
            v-model="formData"
            :schema="schema"
          />

          <template v-slot:buttons>
            <div class="buttons is-justified-center">
              <router-link
                class="is-danger link"
                :to="{ name: 'login' }"
              >
                Back to login
              </router-link>

              <b-button
                type="is-primary"
                native-type="submit"
                expanded
                rounded
                :loading="loading"
              >
                Send reset link
                <b-icon
                  icon="arrow-right"
                  size="is-small"
                />
              </b-button>
            </div>
          </template>

        </form-wrapper>
      </api-wrapper>
    </template>
  </authentication-layout>
  <!-- eslint-disable-next-line -->
</template>

<script>
import AuthenticationLayout from '@/layouts/AuthenticationLayout'
import FormGenerator from '@/components/form/FormGenerator.vue'
import FormWrapper from '@/components/form/FormWrapper.vue'
import ApiWrapper from '@/components/http/ApiWrapper.js'
import requestResetSchema from '@/helpers/schemas/requestResetSchema'

export default {
  name: 'ForgotPassword',
  components: {
    AuthenticationLayout,
    FormGenerator,
    FormWrapper,
    ApiWrapper
  },
  data () {
    return {
      formData: {
        email: '',
        password: ''
      },
      schema: requestResetSchema
    }
  },
  methods: {
    handleRouting () {
      this.$router.push({ name: 'ResetPassword' })
    }
  }
}
</script>

<style lang="scss" scoped>
  .link {
    width: 100%;
    text-align: center;
    font-size: 0.75em;
    margin-bottom: 1.5em;
  }
</style>
