import { getEndpoint } from '@/helpers/http'
import crudService from '@/services/CrudService'

export default {
  name: 'CrudWrapper',
  props: {
    endpoint: {
      type: String,
      required: true
    },
    identifier: {
      type: String,
      default: 'id'
    }
  },
  data () {
    return {
      data: undefined,
      columns: [],
      filters: {},
      meta: null,
      error: null,
      loading: false
    }
  },
  computed: {
    resourceId () {
      return this.$route.params[this.identifier]
    }
  },
  methods: {
    async sendRequest (uri, method, payload = undefined) {
      this.loading = true

      try {
        const response = await crudService[method](uri, payload)
        this.data = response.data
        this.columns = response.columns
        this.meta = response.meta
        this.filters = response.filters
        this.error = null

        if (method !== 'read') {
          this.$emit('success', response)
        }

        this.loading = false
        return response
      } catch (error) {
        this.data = {}
        this.columns = null
        this.meta = null
        this.filters = null
        this.error = error.data

        this.$emit('error', error)
        this.loading = false
        this.handleError()
      }
    },
    getAll (queryString = '') {
      return this.sendRequest(`${this.endpoint}${queryString}`, 'getAll')
    },
    create (payload) {
      return this.sendRequest(this.endpoint, 'create', payload)
    },
    async read () {
      return this.sendRequest(`${this.endpoint}/${this.resourceId}`, 'read')
    },
    update (payload, id = false) {
      return this.sendRequest(`${this.endpoint}/${id || this.resourceId}`, 'update', payload)
        .then(response => {
          this.$emit('updated')
        })
    },
    remove (id = false) {
      return this.sendRequest(`${this.endpoint}/${id || this.resourceId}`, 'remove')
        .then(() => {
          this.$emit('remove')
        })
    },
    getEndpoint (endpointString) {
      try {
        return getEndpoint(endpointString)
      } catch (error) {
        this.error = error
        return error
      }
    },
    handleError () {
      this.$buefy.toast.open({
        message: this.error.message,
        type: 'is-danger'
      })
    }
  },
  render () {
    return this.$scopedSlots && this.$scopedSlots.default({
      data: this.data,
      columns: this.columns,
      meta: this.meta,
      filters: this.filters,
      getAll: this.getAll,
      create: this.create,
      read: this.read,
      update: this.update,
      remove: this.remove,
      loading: this.loading,
      error: this.error
    })
  }
}
