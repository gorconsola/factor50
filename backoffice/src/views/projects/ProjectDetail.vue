<template>
  <default-layout :secondaryMenuSchema="projectMenuSchema">
    <page-header :title="pageTitle" />

  </default-layout>
</template>

<script>
import DefaultLayout from '@/layouts/DefaultLayout'
import PageHeader from '@/components/ui/PageHeader'
import projectMenuSchema from '@/helpers/schemas/projects/projectMenuSchema.js'

export default {
  name: 'ProjectDetail',
  components: {
    DefaultLayout,
    PageHeader
  },
  data () {
    return {
      projectMenuSchema
    }
  },
  computed: {
    pageTitle () {
      return this.$route.params.id
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
