
<script>
import { createBreadcrumb } from './Breadcrumbs.js'

export default {
  name: 'BreadcrumbsWrapper',
  props: {
    baseCrumb: {
      type: String,
      default: 'home'
    }
  },
  data () {
    return {
      breadcrumbs: this.setBreadcrumbs()
    }
  },
  computed: {
    storeBreadcrumbs () {
      return this.$store.state.breadcrumbs.breadcrumbs
    }
  },
  watch: {
    '$route': function () {
      this.breadcrumbs = this.setBreadcrumbs()
    },
    storeBreadcrumbs: function (newVal) {
      this.breadcrumbs = this.setBreadcrumbs()
    }
  },
  methods: {
    setBreadcrumbs () {
      const dynamicCrumbs = this.storeBreadcrumbs ||
          this.$route.meta.breadcrumbs ||
          this.breadcrumbsFromPath(this.$route.path)

      const baseCrumb = [createBreadcrumb(this.baseCrumb, this.baseCrumb)]

      return baseCrumb.concat(dynamicCrumbs)
    },
    breadcrumbsFromPath (path) {
      let pathArray = path.split('/')

      pathArray = pathArray.filter(path => !!path)

      return pathArray.map(part => {
        return { label: part, route: `${part}` }
      })
    }
  },
  render () {
    return this.$scopedSlots.default({
      breadcrumbs: this.breadcrumbs
    })
  }
}
</script>
