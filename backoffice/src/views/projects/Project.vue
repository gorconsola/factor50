<template>
  <default-layout :secondaryMenuSchema="projectMenuSchema">
    <page-header :title="pageTitle" />

    <crud-wrapper
      ref="crudWrapper"
      identifier="projectId"
      endpoint="projects"
      @remove="handleRemove"
    >
      <template #default="props">

        <router-view
          :project="project"
          v-bind="props"
          @update="handleUpdate" />

      </template>
    </crud-wrapper>
  </default-layout>
</template>

<script>
import CrudWrapper from '@/components/http/CrudWrapper'
import DefaultLayout from '@/layouts/DefaultLayout'
import PageHeader from '@/components/ui/PageHeader'
import projectMenuSchema from '@/helpers/schemas/projects/projectMenuSchema.js'

export default {
  name: 'ProjectDetail',
  components: {
    CrudWrapper,
    DefaultLayout,
    PageHeader
  },
  data () {
    return {
      projectMenuSchema,
      project: undefined
    }
  },
  computed: {
    pageTitle () {
      return (this.project && this.project.name) || this.$route.params.projectId
    }
  },
  mounted () {
    this.getProject()
      .then(() => {
        this.setBreadcrumbs()
      })
  },
  methods: {
    getProject () {
      return this.$refs.crudWrapper.read()
        .then(response => {
          this.project = this.$refs.crudWrapper.data
        })
    },
    handleUpdate (product) {
      return this.$refs.crudWrapper.update(product)
    },
    handleRemove () {
      return this.$router.push({ name: 'new-products' })
    },
    setBreadcrumbs () {
      const breadcrumbs = [
        ['Projects', 'projects'],
        [this.project.name, 'project-details']
      ]

      this.$store.commit('breadcrumbs/SET_BREADCRUMBS', breadcrumbs)
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
