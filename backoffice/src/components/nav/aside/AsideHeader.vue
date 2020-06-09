<template>
  <header>
    <logo />
  </header>
</template>

<script>
import Logo from '@/components/logo/Logo.vue'

export default {
  name: 'AsideHeader',
  components: {
    Logo
  }
}
</script>

<style lang="scss" scoped>
header {
  width: 244px;
  height: 3.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #2A2D2E;
}
</style>
