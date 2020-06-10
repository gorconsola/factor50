<template>
  <tr class="empty">
    <td
      :colspan="`${columnCount}`"
      class="emtpy-table-row"
    >
      No data available
    </td>
  </tr>
</template>

<script>
export default {
  name: 'EmptyTable',
  props: {
    columnCount: {
      type: Number,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
  .empty {
    width: 100%;
  }
  .emtpy-table-row {
    width: 100%;
    text-align: center;
    padding: 4em;
    font-weight: bold;
    background: transparent;
    pointer-event: none;
  }
</style>
