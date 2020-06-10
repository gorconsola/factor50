<template>
  <div
    :class="{sortable: column.sortable}"
    class="sortable-column"
  >
    {{ column.label | title }}

    <div
      v-if="column.sortable"
      class="icons"
    >
      <span
        class="fas is-small"
        :class="{'has-text-primary': isActive && isAsc}"
      >
        <i
          class="fas fa-caret-up"
          @click="setOrder('asc')"
        />
      </span>

      <span
        class="fas is-small"
        :class="{'has-text-primary': isActive && !isAsc}"
      >
        <i
          class="fas fa-caret-down"
          @click="setOrder('desc')"
        />

      </span>
    </div>
  </div>
</template>

<script>
import queryStringMixin from '@/components/http/QueryStringMixin.js'

export default {
  name: 'SortableColumn',
  mixins: [queryStringMixin],
  props: {
    column: {
      type: Object,
      required: true
    },
    filters: {
      type: Object,
      required: true
    }
  },
  computed: {
    isAsc () {
      return this.filters.order_by && this.filters.order_by.value && this.filters.order_by.value.split('-')[1] === 'asc'
    },
    isActive () {
      return this.filters.order_by && this.filters.order_by.value && this.filters.order_by.value.split('-')[0] === this.column.label
    }
  },
  methods: {
    setOrder (order) {
      const _filters = this.filters
      _filters.order_by.value = `${this.column.label}-${order}`

      this.$emit('submit', _filters)
      this.updateQueryString('order_by', _filters.order_by.value)
    }
  }
}
</script>

<style lang="scss" scoped>
  .sortable-column {
    display: flex;

    .icons {
      margin-left: 8px;
      display: flex;
      flex-direction: column;
      justify-content: center;

      span:first-of-type {
        margin-bottom: -7px;
        z-index: 1;
      }
    }
  }
</style>
