<template>
  <div>
    <page-header :title="pageTitle || endpoint" />

    <div class="section">
      <crud-wrapper
        ref="crudWrapper"
        :endpoint="endpoint"
        @success="handleSuccess"
        @updated="response => $emit('updated', response)"
      >
        <template slot-scope="{ loading, create, read, update, remove, data }">
          <slot
            :loading="loading"
            :create="create"
            :read="read"
            :update="update"
            :remove="remove"
            :data="data"
          >
            <card>
              <b-loading
                :is-full-page="true"
                :active.sync="loading"
              />

              <template v-slot:header>
                {{ title }}
              </template>

              <template>
                <form-wrapper
                  ref="formWrapper"
                  @submit="handleSubmit"
                >
                  <form-generator
                    ref="formGenerator"
                    :value="formData"
                    :schema="schema"
                    @input="updateForm"
                  />

                  <template v-slot:buttons>
                    <b-button
                      v-if="isNew"
                      type="is-primary"
                      native-type="submit"
                      :loading="loading"
                    >
                      Opslaan
                    </b-button>

                    <crud-buttons
                      v-else
                      :loading="loading"
                      :show-delete="showDelete"
                      @reset="resetForm"
                      @remove="remove"
                    />
                  </template>
                </form-wrapper>
              </template>
            </card>
          </slot>
        </template>
      </crud-wrapper>
    </div>
  </div>
</template>

<script>
import CrudWrapper from '@/components/http/CrudWrapper'
import FormGenerator from '@/components/form/FormGenerator.vue'
import FormWrapper from '@/components/form/FormWrapper.vue'
import CrudButtons from '@/components/form/CrudButtons.vue'
import PageHeader from '@/components/PageHeader.vue'
import Card from '@/components/ui/Card.vue'

export default {
  name: 'ResourceDetailLayout',
  components: {
    Card,
    PageHeader,
    CrudWrapper,
    FormWrapper,
    CrudButtons,
    FormGenerator
  },
  props: {
    pageTitle: {
      type: String,
      default: undefined
    },
    endpoint: {
      type: String,
      required: true
    },
    schema: {
      type: Array,
      required: true
    },
    value: {
      type: Object,
      required: true
    },
    showDelete: {
      type: Boolean,
      default: true
    },
    routing: {
      type: Boolean,
      default: true
    }
  },
  data () {
    return {
      formData: this.value || {}
    }
  },
  computed: {
    isNew () {
      return this.$route.params.id === 'new'
    },
    title () {
      return this.pageTitle
        ? this.pageTitle
        : this.generatePageTitle()
    }
  },
  mounted () {
    if (!this.isNew) {
      const promise = this.$refs.crudWrapper.read()

      promise.then(() => {
        this.updateForm(this.$refs.crudWrapper.data)

        if (this.$refs.formGenerator) {
          this.$refs.formGenerator.formData = this.$refs.crudWrapper.data
        }

        this.$emit('read')
      })
    }
  },
  methods: {
    handleSuccess () {
      this.$emit('success')

      if (this.routing) {
        this.handleRouting()
      }
    },
    handleRouting () {
      const parentRoute = this.getParentRoute()

      this.$router.push(parentRoute)
    },
    handleSubmit () {
      return this.isNew
        ? this.$refs.crudWrapper.create(this.formData)
        : this.$refs.crudWrapper.update(this.formData)
    },
    resetForm () {
      this.$refs.crudWrapper.read()
        .then(() => {
          this.updateForm(this.$refs.crudWrapper.data)

          if (this.$refs.formGenerator) {
            this.$refs.formGenerator.formData = this.$refs.crudWrapper.data
          }
        })
    },
    updateForm (formData) {
      this.formData = formData

      this.$emit('input', this.formData)
    },
    generatePageTitle () {
      const lastChar = this.endpoint.charAt(this.endpoint.length - 1)

      // Make resource singular of last character is an 's'
      const resourceName = lastChar === 's'
        ? this.endpoint.substring(0, this.endpoint.length - 1)
        : this.endpoint

      // Set string depending on new or existing resource
      return this.isNew
        ? `New ${resourceName}`
        : `Update ${resourceName}`
    },
    getParentRoute () {
      const regex = RegExp(`/${this.$route.params.id}`, 'g')
      const match = regex.exec(this.$route.path)

      const parentPath = this.$route.path.substring(0, match.index)

      return parentPath
    }
  }
}
</script>
