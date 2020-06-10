<template>
  <tr>
    <th
      v-for="(column, index) in columns"
      :key="index"
      class="filter-row"
    >

      <filter-generator
        v-if="filters[column.label]"
        :value="filters[column.label].value"
        :tag="filters[column.label].type"
        :filter="filters[column.label]"
        @input="updateFilters(column.label, $event)"
        @submit="submitFilters"
      />

    </th>
  </tr>
</template>

<script>
import FilterGenerator from '@/components/table/ChimpTableFilters/FilterGenerator.vue'

export default {
  name: 'ChimpTableFilters',
  components: { FilterGenerator },
  props: {
    filters: {
      type: Object,
      required: true
    },
    columns: {
      type: Array,
      required: true
    }
  },
  methods: {
    updateFilters (fieldName, value) {
      this.filters[fieldName].value = value

      this.$emit('input', this.filters)
    },
    submitFilters () {
      this.$emit('submit', this.filters)
    }
  }
}
</script>

<style lang="scss" scoped>
  .filter-row {
    background: #eeeeee;
  }
</style>
