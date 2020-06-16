<template>
  <div class="document-tile">
    <div class="card">
      <div class="card-content">
        <div
          class="delete"
          @click="remove"
        />
        <b-icon
          icon="fa fa-file-alt"
          type="is-danger"
        />
      </div>
      <div class="card-footer">
        <a
          target="_blank"
          class="download"
          @click.prevent="downloadPDF(doc.path, doc.name)"
        >
          <p>{{ doc.name }}</p>
        </a>
      </div>
    </div>

    <select-field
      name="status"
      :value="doc.type"
      :options="productDocumentOptions"
      placeholder="Pick a document type"
      rules=""
      @input="handleInput"
    />

    <switch-field
      :value="!!doc.published"
      :disabled="!doc.type"
      name="published"
      label="Published"
      type="is-success"
      class="switch"
      @input="togglePublish"
    />

    <b-field
      :message="doc.type ? '' : 'Select a document type before publishing'"
      type="is-danger"
    />
  </div>
</template>

<script>
import productDocumentOptions from '@/helpers/productDocumentHelper'
import SelectField from '@/components/form/FormComponents/SelectField.vue'
import SwitchField from '@/components/form/FormComponents/SwitchField.vue'

export default {
  name: 'DocumentTile',
  inject: ['$validator'],
  components: {
    SelectField,
    SwitchField
  },
  props: {
    doc: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      productDocumentOptions
    }
  },
  methods: {
    handleInput (value) {
      const result = this.doc
      result.type = value

      this.$emit('update', result)
    },
    togglePublish (value) {
      const result = this.doc
      result.published = value

      this.$emit('update', result)
    },
    remove () {
      this.$buefy.dialog.confirm({
        title: 'Deleting document',
        message: 'Are you sure you want to delete this document? This action can\'t be undone.',
        confirmText: 'Delete Document',
        type: 'is-danger',
        hasIcon: true,
        onConfirm: () => this.$emit('remove', this.doc)
      })
    },
    downloadPDF (url, fileName) {
      this.$emit('download', url, fileName)
    }
  }
}
</script>

<style lang="scss" scoped>
  .document-tile {
    margin-right: 1.5em;
    margin-bottom: 1.5em;
    width: 200px;

    .card {
      height: 250px;
      border: none;
      box-shadow: none;
      margin-bottom: 1.5em;
      position: relative;
      display: flex;
      flex-direction: column;

      .card-content {
        border: 1px solid #EAEDF0;
        border-bottom: none;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .delete {
        opacity: 0;
        position: absolute;
        top: 1rem;
        right: 1rem;
      }
      &:hover {
        .delete {
          opacity: 1;
        }
      }
    }

    .card-footer {
      border: 1px solid #EAEDF0;
      border-top: none;
      padding: 1em;
      font-weight: bold;
      font-size: 12px;
      word-break: break-word;
      max-width: 200px;
    }

    .switch {
      margin-top: 1em;
    }
  }
</style>
