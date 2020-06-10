<template>
  <authentication-layout title="Login">
    <template v-slot:form>
      <api-wrapper
        endpoint="accountService.login"
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
                :to="{ name: 'forgot-password' }"
              >
                Forgot password?
              </router-link>

              <b-button
                type="is-primary"
                native-type="submit"
                expanded
                rounded
                :loading="loading"
              >
                Login
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
</template>

<script>
import AuthenticationLayout from '@/layouts/AuthenticationLayout'
import FormGenerator from '@/components/form/FormGenerator.vue'
import FormWrapper from '@/components/form/FormWrapper.vue'
import ApiWrapper from '@/components/http/ApiWrapper.js'
import loginSchema from '@/helpers/schemas/loginSchema'

export default {
  name: 'Login',
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
      schema: loginSchema
    }
  },
  methods: {
    handleRouting () {
      this.$router.push({ name: 'dashboard' })
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
