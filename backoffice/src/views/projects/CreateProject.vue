<template>
  <default-layout>
    <page-header title="Create New Project" />

    <crud-wrapper
      ref="crudWrapper"
      identifier="productId"
      endpoint="new-products"
    >
      <section class="page-section form-cards-container">
        <template>

          <div class="card-container">
            <form-card
              title="Project Details"
              :schema="newProjectSchema"
              :formData.sync="formData"
              :hideButtons="true" />

          </div>

          <div class="card-container">
            <form-card
              title="Contact details"
              :schema="locationSchema"
              :formData.sync="formData"
              :hideButtons="true" />

          </div>

        </template>
      </section>
    </crud-wrapper>

  </default-layout>
</template>

<script>
import CrudWrapper from '@/components/http/CrudWrapper'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import FormCard from '@/components/form/FormCard.vue'
import PageHeader from '@/components/ui/PageHeader.vue'
import locationSchema from '@/helpers/schemas/projects/locationSchema.js'
import newProjectSchema from '@/helpers/schemas/projects/newProjectSchema.js'

export default {
  name: 'CreateProject',
  components: {
    CrudWrapper,
    DefaultLayout,
    FormCard,
    PageHeader
  },
  data () {
    return {
      locationSchema: locationSchema,
      newProjectSchema: newProjectSchema,
      formData: {
        project: {
          title: ''
        },
        address: {
          first_name: '',
          last_name: '',
          email: '',
          phone: '',
          street: '',
          house_number: '',
          house_number_addition: '',
          postal_code: '',
          city: '',
          country: ''
        }
      }
    }
  },
  methods: {
    handleSubmit (payload) {
      this.$refs.crudWrapper.create(payload)
        .then(response => {
          this.handleSuccess()
        })
    },
    handleSuccess () {
      this.$buefy.toast.open({
        message: 'New project saved',
        type: 'is-primary'
      })
    }
  }
}
</script>

<style lang="scss" scoped>
  .card-container {
    margin-bottom: 2rem;
  }
</style>
