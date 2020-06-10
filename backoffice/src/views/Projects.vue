<template>
  <default-layout>
    <page-header title="Projects" />

    <crud-wrapper
      ref="crudWrapper"
      endpoint="projects"
    >
      <template>
        <div>
          {{ projects }}
        </div>
      </template>
    </crud-wrapper>

  </default-layout>
</template>

<script>
import CrudWrapper from '@/components/http/CrudWrapper'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import PageHeader from '@/components/ui/PageHeader.vue'

export default {
  name: 'Dashboard',
  components: {
    CrudWrapper,
    DefaultLayout,
    PageHeader
  },
  data () {
    return {
      projects: []
    }
  },
  mounted () {
    this.$refs.crudWrapper.getAll()
      .then(response => {
        console.log('response: ', response)
        this.projects = response
      })
  }
}
</script>

<style lang="scss" scoped>

</style>
