<template>
  <default-layout>

    <resource-listing-layout
      endpoint="projects"
      page-title="Projects"
      :showNewResourceButton="true"
      @click="handleRouting" />

  </default-layout>
</template>

<script>
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import QueryStringMixin from '@/components/http/QueryStringMixin.js'
import ResourceListingLayout from '@/layouts/ResourceListingLayout.vue'

export default {
  name: 'Dashboard',
  mixins: [QueryStringMixin],
  components: {
    DefaultLayout,
    ResourceListingLayout
  },
  methods: {
    handleRouting ({ id }) {
      this.$router.push(`${this.$route.path}/${id}`)
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
