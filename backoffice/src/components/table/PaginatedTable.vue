<template>
  <div>
    <div class="header">
      <h1>{{ title }}</h1>

      <pagination
        v-if="data && data.length && meta"
        :meta="meta"
        page-count
        @update="handleUpdatePage" />

    </div>

    <base-table
      :data="data"
      :columns="columns"
      :loading="loading"
      @click="(row) => $emit('click', row)"
    >
      <template #header-columns="{ column }">

        <sortable-column
          :column="column"
          :filters="filters"
          @submit="submitFilters" />

      </template>

      <template
        v-if="filters"
        v-slot:filters
      >

        <chimp-table-filters
          :filters="filters"
          :columns="columns"
          @submit="submitFilters" />

      </template>

      <template
        v-if="$scopedSlots.default"
        #default="{ row, index }"
      >

        <slot
          :row="row"
          :index="index" />

      </template>
    </base-table>

    <div
      v-if="data && data.length && meta"
      class="card-footer"
    >

      <pagination
        :meta="meta"
        @update="handleUpdatePage" />

    </div>
  </div>
</template>

<script>
import BaseTable from '@/components/table/BaseTable.vue'
import SortableColumn from '@/components/table/SortableColumn.vue'
import Pagination from '@/components/nav/pagination/Pagination.vue'
import QueryStringMixin from '@/components/http/QueryStringMixin'
import ChimpTableFilters from '@/components/table/ChimpTableFilters/ChimpTableFilters.vue'

export default {
  name: 'PaginatedTable',
  components: {
    BaseTable,
    SortableColumn,
    Pagination,
    ChimpTableFilters
  },
  mixins: [QueryStringMixin],
  props: {
    data: {
      required: true,
      validate: (value) => ['array', 'undefined'].find(typeof value)
    },
    columns: {
      type: Array,
      required: true
    },
    meta: {
      type: Object,
      required: false,
      default: () => {}
    },
    filters: {
      type: Object,
      required: false,
      default: () => {}
    },
    loading: {
      type: Boolean,
      default: false
    },
    title: {
      type: String,
      default: 'Overview'
    },
    hoverable: {
      type: Boolean,
      default: true
    },
    scrollable: {
      type: Boolean,
      default: true
    }
  },
  data () {
    return {
      activeFilters: {},
      activePageParams: {}
    }
  },
  computed: {
    queryObject () {
      return { ...this.activePageParams, ...this.activeFilters } || {}
    }
  },
  methods: {
    handleRouting ({ id }) {
      this.$router.push(`${this.$route.path}/${id}`)
    },
    handleUpdatePage (payload) {
      this.activeFilters = this.getActiveFilters(this.filters)

      this.activePageParams = {
        per_page: payload.per_page,
        page: payload.page
      }

      const queryString = this.createQueryStringFromObject(this.queryObject)

      this.$emit('update', queryString)
    },
    submitFilters (filters) {
      this.activeFilters = this.getActiveFilters(filters)
      this.activePageParams = this.getCurrentPageParams()

      const queryString = this.createQueryStringFromObject(this.queryObject)

      this.$emit('update', queryString)
    },
    getActiveFilters (filters) {
      const activeFilters = Object.values(filters).filter(filter => {
        return !!filter.value
      })

      const result = {}

      activeFilters.map(filter => {
        Object.assign(result, { [filter.name]: filter.value })
      })

      return result
    },
    getCurrentPageParams () {
      return {
        per_page: this.meta.per_page,
        page: this.meta.current_page
      }
    }
  }
}
</script>

<style lang="scss" scoped>
  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid rgba(0,0,0,0.1);

    h1 {
      margin: 0;
    }
  }

  .card-footer {
    display: flex;
    justify-content: flex-end;
    padding: 20px;
  }
</style>
