<script>
import queryStringMixin from '@/components/http/QueryStringMixin.js'

export default {
  name: 'PaginationWrapper',
  mixins: [ queryStringMixin ],
  props: {
    meta: {
      type: Object
    }
  },
  methods: {
    previous () {
      this.updatePage(this.current_page - 1)
    },
    next () {
      this.updatePage(this.current_page + 1)
    },
    updatePage (newPage) {
      const payload = this.createPaginationObject(newPage)

      this.$emit('updatePage', payload)
      this.updateQueryString('page', newPage)
    },
    updatePageCount (newPageCount) {
      const payload = this.createPaginationObject(1, newPageCount)

      this.$emit('updatePage', payload)
      this.updateQueryString('per_page', newPageCount)
    },
    createPaginationObject (newPage, pageCount = this.meta.per_page) {
      return {
        page: newPage,
        per_page: pageCount
      }
    }
  },
  render () {
    return this.$scopedSlots.default({
      previous: this.previous,
      next: this.next,
      updatePage: this.updatePage,
      updatePageCount: this.updatePageCount,
      paginator: this.meta
    })
  }
}
</script>

<style lang="scss" scoped>

</style>
