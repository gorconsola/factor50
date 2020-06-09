import { getEndpoint } from '@/helpers/http'

export default {
  name: 'ApiWrapper',
  props: {
    endpoint: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      data: [],
      error: null,
      loading: false
    }
  },
  methods: {
    async sendRequest (payload = undefined) {
      // get endpoint from services folder
      const endpoint = this.getEndpoint(this.endpoint)

      this.loading = true

      try {
        const response = await endpoint(payload)

        this.data = response.data
        this.error = null
        this.$emit('success', response)
        this.loading = false

        return response
      } catch (error) {
        this.data = []
        this.error = error

        this.handleError()
      }

      this.loading = false
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
        message: this.error.message || this.error.data.message,
        type: 'is-danger'
      })

      this.$emit('error', this.error)
    }
  },
  render () {
    return this.$scopedSlots.default({
      sendRequest: this.sendRequest,
      data: this.data,
      loading: this.loading,
      error: this.error
    })
  }
}
