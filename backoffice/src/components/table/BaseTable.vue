<template>
  <div :class="{'table-container': scrollable}">
    <table
      class="table"
      :class="{'is-hoverable': hoverable && data.length, 'is-full': isFull}"
    >
      <thead>
        <tr>
          <th v-for="(column, index) in columns" :key="index">
            <slot
              name="header-columns"
              :column="column"
            >
              {{ column.label | title }}
            </slot>
          </th>
        </tr>

        <slot name="filters" />
      </thead>

      <tbody>
        <b-loading
          :is-full-page="false"
          :active.sync="loading"
        />

        <template v-for="(row, index) in data">
          <tr
            :key="index"
            :class="{'is-hoverable': hoverable}"
            @click="selectRow(row)"
          >
            <slot
              :row="row"
              :index="index"
            >

              <td
                v-for="(column, columnIndex) in columns"
                :key="`${index}-${columnIndex}`"
              >

                <slot
                  name="column"
                  :row="row"
                  :column="column"
                >

                  {{ row[column.label] }}

                </slot>
              </td>
            </slot>
          </tr>
        </template>

        <slot
          v-if="!data.length && !loading"
          name="empty"
        >
          <empty-table
            v-if="columns"
            :column-count="columns.length" />

        </slot>
      </tbody>
    </table>
  </div>
</template>

<script>
import EmptyTable from '@/components/table/EmptyTable.vue'

export default {
  name: 'BaseTable',
  components: { EmptyTable },
  props: {
    data: {
      type: [Array, Object],
      required: true
    },
    columns: {
      type: Array,
      required: true
    },
    loading: {
      type: Boolean,
      default: false
    },
    hoverable: {
      type: Boolean,
      default: true
    },
    scrollable: {
      type: Boolean,
      default: true
    },
    isFull: {
      type: Boolean,
      default: true
    }
  },
  methods: {
    selectRow (row) {
      this.$emit('click', row)
    }
  }
}
</script>

<style lang="scss" scoped>
  .filter-row {
    background: rgba(237,242,246,1);
  }

  .table-container {
    margin-bottom: 0;
  }

  .table {
    &.is-full {
      width: 100%;
    }
  }

  tr {
    &.is-hoverable {
      cursor: pointer;
    }
  }
</style>
