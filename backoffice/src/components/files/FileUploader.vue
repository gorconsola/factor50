<template>
  <form-wrapper @submit="handleSubmit(formData)">
    <form-generator
      v-model="formData"
      :schema="schema"
      @input="handleInput"
    />

    <template
      v-if="manualSave"
      v-slot:buttons
    >
      <b-button
        type="is-primary"
        native-type="submit"
        :disabled="!formData.files.length"
      >
        Save
      </b-button>
    </template>
  </form-wrapper>
</template>

<script>
import FormGenerator from '@/components/form/FormGenerator.vue'
import FormWrapper from '@/components/form/FormWrapper.vue'
import documentService from '@/services/DocumentService.js'

export default {
  name: 'FileUploader',
  components: {
    FormWrapper,
    FormGenerator
  },
  props: {
    folder: {
      type: String,
      required: true
    },
    manualSave: {
      type: Boolean,
      default: true
    }
  },
  data () {
    return {
      formData: {
        files: []
      },
      schema: [{
        fieldType: 'FileUploadInput',
        name: 'files',
        label: 'Document upload',
        manualSave: this.manualSave,
        showTags: this.manualSave,
        allowedFileTypes: ['application/pdf', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'xls', 'doc', 'sheet']
      }]
    }
  },
  methods: {
    submitFiles ({ files }) {
      const parsedFiles = []

      files.forEach(file => {
        parsedFiles.push(this.fileToBase64(file))
      })

      return Promise.all(parsedFiles)
        .then(files => {
          const payload = {
            folder: this.folder,
            files: files
          }

          this.$emit('submit', payload)
          this.formData.files = []
        })
    },
    fileToBase64 (file) {
      return documentService.getBase64(file)
        .then(rawData => {
          return {
            data: rawData,
            name: file.name,
            type: file.type
          }
        })
    },
    handleInput (value) {
      if (!this.manualSave) {
        this.handleSubmit(value)
      }
    },
    handleSubmit (formData) {
      this.submitFiles(formData)
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
