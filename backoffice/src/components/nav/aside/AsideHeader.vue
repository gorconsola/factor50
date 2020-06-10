<template>
  <header class="header">
    <h3 class="title is-3"><span v-html="'&#9650;'"></span>SPF50</h3>
  </header>
</template>

<script>
export default {
  name: 'AsideHeader'
}
</script>

<style lang="scss" scoped>
.header {
  width: 244px;
  height: 3.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #1a202c;

  .title {
    color: white !important;
    text-align: center;
  }

  span {
    color: tomato !important;
  }
}
</style>
