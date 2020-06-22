<template>
  <crud-wrapper
    ref="crudWrapper"
    :endpoint="endpoint"
  >
    <form-wrapper
      slot-scope="{ loading, update }"
      @submit="handleSubmit"
    >

      <form-generator
        v-model="formData"
        :schema="taskDetailSchema"
      />

      <template v-slot:buttons>
        <b-button
          tag="button"
          native-type="submit"
          type="is-primary"
        >
          Save
        </b-button>
      </template>

    </form-wrapper>
  </crud-wrapper>
</template>

<script>
import FormGenerator from '@/components/form/FormGenerator.vue'
import FormWrapper from '@/components/form/FormWrapper.vue'
import CrudWrapper from '@/components/http/CrudWrapper.js'
import taskDetailSchema from '@/helpers/schemas/tasks/taskDetailSchema'

export default {
  name: 'TaskDetails',
  components: { FormGenerator, FormWrapper, CrudWrapper },
  props: {
    task: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      taskDetailSchema,
      formData: {
        title: '',
        description: ''
      }
    }
  },
  computed: {
    endpoint () {
      return `projects/${this.$route.params.projectId}/tasks`
    }
  },
  mounted () {
    this.setFormData()

    console.log('this.task: ', this.task)
  },
  methods: {
    setFormData () {
      Object.keys(this.task).map(key => {
        this.$set(this.formData, key, this.task[key])
      })
    },
    handleSubmit () {
      return this.$refs.crudWrapper.update(this.formData, this.task.id)
    }
  }
}
</script>

<style lang="scss" scoped>

</style>