<template>
  <div class="">
    <page-header :title="title">
      <template v-slot:buttons v-if="showNewResourceButton">
          <b-button
            type="is-primary"
            tag="router-link"
            icon-left="flask-plus-outline"
            :to="`${$route.path}/new`"
            rounded
          >
            Add new
          </b-button>
        <slot name="extra-buttons">
        </slot>
      </template>
    </page-header>

    <div class="section">
      <crud-wrapper
        ref="crudWrapper"
        :endpoint="endpoint"
      >
        <template slot-scope="{ loading, getAll, data, columns, meta, filters }">
          <card :padding="false">
            <template>
              <div>
                <slot
                  :data="data"
                  :columns="columns"
                  :loading="false"
                  :meta="meta"
                  :filters="filters"
                  :getAll="getAll"
                >
                  <paginated-table
                    :data="data"
                    :columns="columns"
                    :loading="loading"
                    :meta="meta"
                    :filters="filters"
                    @update="getAll"
                    @click="handleRouting"
                  />
                </slot>
              </div>
            </template>
          </card>
        </template>
      </crud-wrapper>
    </div>
  </div>
</template>

<script>
import PageHeader from '@/components/ui/PageHeader.vue'
import CrudWrapper from '@/components/http/CrudWrapper'
import PaginatedTable from '@/components/table/PaginatedTable'
import Card from '@/components/ui/Card.vue'
import QueryStringMixin from '@/components/http/QueryStringMixin.js'

export default {
  name: 'ResourceListingLayout',
  components: {
    PageHeader,
    CrudWrapper,
    PaginatedTable,
    Card
  },
  mixins: [QueryStringMixin],
  props: {
    pageTitle: {
      type: String,
      default: undefined
    },
    endpoint: {
      type: String,
      required: true
    },
    showNewResourceButton: {
      type: Boolean,
      default: true
    }
  },
  computed: {
    isNew () {
      return this.$route.params.id === 'new'
    },
    title () {
      return this.pageTitle
        ? this.pageTitle
        : `${this.endpoint}`
    }
  },
  mounted () {
    this.$refs.crudWrapper.getAll(this.getQueryStringFromUrl())
  },
  methods: {
    handleRouting ({ id }) {
      this.$router.push(`${this.$route.path}/${id}`)
    }
  }
}
</script>
