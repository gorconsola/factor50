<template>
  <api-wrapper
    endpoint="documentService.upload"
    @success="handleSuccess"
  >
    <template slot-scope="{ sendRequest }">
      <file-uploader
        :folder="folderPath"
        :show-tags="showTags"
        :manual-save="manualSave"
        @submit="sendRequest"
      />
    </template>
  </api-wrapper>
</template>

<script>
import ApiWrapper from '@/components/http/ApiWrapper.js'
import FileUploader from '@/components/files/FileUploader.vue'

export default {
  name: 'Documents',
  components: {
    ApiWrapper,
    FileUploader
  },
  props: {
    folderPath: {
      type: String,
      required: true
    },
    showTags: {
      type: Boolean,
      default: true
    },
    manualSave: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    handleSuccess ({ data }) {
      this.$emit('success', data)
    }
  }
}
</script>
