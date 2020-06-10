<template>
  <ul class="pretty-print-list">
    <li v-for="(value, key) in data">
      <span><strong>{{ key }}:</strong></span>

      <template v-if="typeof value === 'string'">
        <span>{{ value }}</span>
      </template>

      <template v-else>
        <pretty-print-object :data="value" />
      </template>
    </li>
  </ul>
</template>

<script>
export default {
  name: 'PrettyPrintObject',
  props: {
    data: {
      type: Object,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
@import '~@/assets/scss/_all.scss';

  ul {
    font-size: 16px;
    line-height: 1.4rem;
    padding-left: 1em;
    color: $black;

    li {
      span {
        &:first-of-type {
          margin-right: 10px;
        }

        strong {
          color: $dark-grey;
        }
      }
    }
  }
</style>
