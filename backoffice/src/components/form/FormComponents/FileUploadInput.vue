<template>
  <div class="form-field">
    <b-field
      :label="label"
      :message="errorMessage"
      :type="{'is-danger': errors.has(name)}"
      :horizontal="horizontal"
    >
      <b-upload
        v-validate="`${rules}`"
        :name="name"
        :value="value"
        icon="fa fa-file-upload"
        multiple
        drag-drop
        expanded
        @input="handleInput"
      >
        <section class="section">
          <div class="content has-text-centered">
            <p>
              <b-icon
                icon="upload"
                size="is-medium"
              />
            </p>
            <p>{{ placeholder }}</p>
          </div>
        </section>
      </b-upload>
    </b-field>

    <slot
      v-if="showTags"
      name="value"
      :files="dropFiles"
    >
      <div class="tags">
        <span
          v-for="(file, index) in dropFiles"
          :key="index"
          class="tag is-outline"
        >

          {{ file.name }}

          <button
            class="delete is-small"
            type="button"
            @click="deleteDropFile(index)"
          />
        </span>
      </div>
    </slot>
  </div>
</template>

<script>
import formFieldMixin from '@/mixins/formFieldMixin'

export default {
  name: 'FileUploadInput',
  inject: ['$validator'],
  mixins: [formFieldMixin],
  props: {
    name: {
      type: String,
      required: true
    },
    value: {
      type: Array,
      required: true
    },
    label: {
      type: String,
      default: ''
    },
    placeholder: {
      type: String,
      default: 'Drop your files here or click to upload'
    },
    loading: {
      type: Boolean,
      default: false
    },
    tags: {
      type: Boolean,
      default: true
    },
    btnTxt: {
      type: String,
      default: ''
    },
    horizontal: {
      type: Boolean,
      default: false
    },
    rules: {
      type: String,
      required: false,
      default: ''
    },
    multiple: {
      type: Boolean,
      default: true
    },
    maxFileSize: {
      type: Number,
      default: 5000000
    },
    allowedFileTypes: {
      type: Array,
      default: () => [
        'image/png',
        'image/jpeg'
      ]
    },
    showTags: {
      type: Boolean,
      default: true
    },
    manualSave: {
      type: Boolean,
      default: true
    }
  },
  data () {
    return {
      dropFiles: []
    }
  },
  methods: {
    deleteDropFile (index) {
      this.dropFiles.splice(index, 1)
      this.handleInput(this.dropFiles)
    },
    handleInput (files) {
      return Promise.all(files.map(file => {
        return this.checkFile(file)
      })).then(() => {
        this.$emit('input', this.dropFiles)
        this.dropFiles = []
      })
    },
    checkFile (file) {
      return new Promise((resolve, reject) => {
        if (!this.fileTypeAllowed(file)) {
          return reject(this.fileTypeNotAllowed(file))
        }

        if (!this.fileSizeAllowed(file)) {
          return reject(this.fileSizeToBig(file))
        }

        this.dropFiles.push(file)
        return resolve()
      })
    },
    fileTypeAllowed (file) {
      return this.allowedFileTypes.indexOf(file.type) !== -1
    },
    fileSizeAllowed (file) {
      return file.size <= this.maxFileSize
    },
    fileTypeNotAllowed (file) {
      throw new Error(`File type '${file.type}' not allowed.`)
    },
    fileSizeToBig (file) {
      throw new Error(`Image '${file.name}' is too big. Please minify the image.`)
    }
  }
}
</script>
