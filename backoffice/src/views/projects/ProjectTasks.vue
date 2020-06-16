<template>
  <resource-listing-layout
    :endpoint="endpoint"
    @click="handleRouting"
  />
</template>

<script>
import ResourceListingLayout from '@/layouts/ResourceListingLayout.vue'

export default {
  name: 'ProductVariants',
  components: {
    ResourceListingLayout
  },
  props: {
    data: {
      type: [Array, Object],
      required: true
    }
  },
  computed: {
    endpoint () {
      return `projects/${this.$route.params.projectId}/tasks`
    }
  },
  methods: {
    handleRouting ({ id }) {
      this.$router.push(`${this.$route.path}/${id}`)
    }
  }
}
</script>
