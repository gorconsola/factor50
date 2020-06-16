<template>
  <crud-wrapper
    ref="documentCrud"
    :endpoint="documentCrudEndpoint"
  >
    <template #default="props">
      <product-detail-layout :title="data.name || 'Documents'">
        <card>
          <template v-slot:header>
            Documents
          </template>

          <div class="documents">
            <document-tile
              v-for="(doc, index) in documents"
              :key="index"
              :doc="doc"
              @update="doc => updateDocument(doc, index)"
              @remove="removeDocument"
              @download="downloadPDF"
            />
          </div>

          <documents
            :folder-path="folderPath"
            :show-tags="false"
            :manual-save="false"
            @success="uploaded"
          />

          <crud-buttons
            :loading="props.loading"
            :show-delete="false"
            @reset="getAllProductDocuments"
            @submit="saveChanges"
          />
        </card>
      </product-detail-layout>
    </template>
  </crud-wrapper>
</template>

<script>
import Card from '@/components/ui/Card.vue'
import CrudWrapper from '@/components/http/CrudWrapper'
import documentService from '@/services/DocumentService.js'
import Documents from '@/components/files/Documents.vue'
import CrudButtons from '@/components/form/CrudButtons.vue'
import DocumentTile from '@/components/files/DocumentTile.vue'
import ProductDetailLayout from '@/layouts/ProductDetailLayout'

export default {
  name: 'ProjectDocuments',
  components: {
    Card,
    Documents,
    CrudButtons,
    CrudWrapper,
    DocumentTile,
    ProductDetailLayout
  },
  props: {
    data: {
      type: [Array, Object],
      required: true
    }
  },
  data () {
    return {
      documents: []
    }
  },
  computed: {
    folderPath () {
      return this.$route.params.projectId
    },
    documentCrudEndpoint () {
      return `projects/${this.$route.params.projectId}/documents`
    }
  },
  mounted () {
    this.getAllProductDocuments()
  },
  methods: {
    uploaded ({ files }) {
      return Promise.all(files.map(file => {
        return this.createDocumentProduct(file)
      }))
        .then(() => {
          return this.getAllProductDocuments()
        })
    },
    createDocumentProduct (file) {
      const payload = {
        base_product_id: this.$route.params.projectId,
        name: file.name,
        path: file.path
      }

      return this.$refs.documentCrud.create(payload)
    },
    getAllProductDocuments () {
      return this.$refs.documentCrud.getAll()
        .then(() => {
          this.documents = this.$refs.documentCrud.data
        })
    },
    updateDocument (doc, index) {
      this.documents[index] = doc
    },
    removeDocument (doc) {
      return this.$refs.documentCrud.remove(doc.id)
        .then(response => {
          this.getAllProductDocuments()
        })
    },
    saveChanges () {
      return Promise.all(this.documents.map(doc => {
        return this.$refs.documentCrud.update(doc, doc.id)
      }))
        .then(() => {
          this.$buefy.toast.open({
            message: 'Alle wijzigingen zijn opgeslagen!',
            type: 'is-primary'
          })
        })
    },
    downloadPDF (url, fileName) {
      return documentService.downloadDocument(url)
        .then(response => {
          const blob = new Blob([response], { type: 'application/pdf' })
          const link = document.createElement('a')
          link.href = window.URL.createObjectURL(blob)
          link.download = fileName
          link.click()
        })
    }
  }
}
</script>

<style lang="scss" scoped>
  .top-image-card {
    margin-bottom: 2em;
  }

  .documents {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
  }
</style>
