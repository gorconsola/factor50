<template>
  <li>
    <b-button tag="a" v-if="!creating" @click="addNewTask">
      Add new task
    </b-button>

    <form-wrapper
      v-show="creating"
      @submit="handleSubmit"
    >

      <form-generator
        v-model="formData"
        :schema="schema"
      />

    </form-wrapper>
  </li>
</template>

<script>
import FormGenerator from '@/components/form/FormGenerator.vue'
import FormWrapper from '@/components/form/FormWrapper.vue'

export default {
  name: 'CreateTask',
  components: {
    FormGenerator,
    FormWrapper
  },
  data () {
    return {
      creating: false,
      formData: {
        title: '',
        status: 'open',
        project_id: this.$route.params.projectId
      },
      schema: [
        {
          fieldType: 'InputField',
          name: 'title',
          type: 'text',
          placeholder: 'Task title',
          reference: 'new-task-input',
          rules: 'required',
          class: 'is-full'
        }
      ]
    }
  },
  methods: {
    handleSubmit () {
      this.$emit('create', this.formData)
      this.creating = false
    },
    addNewTask () {
      this.creating = !this.creating

      const input = document.getElementById('new-task-input')
      console.log('input: ', input)
      input.focus()
    }
  }
}
</script>

<style lang="scss" scoped>
  li {
    list-style-type: none;
    padding: 0;
    width: 100%;
  }
</style>
