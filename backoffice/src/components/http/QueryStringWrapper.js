export default {
  name: 'QueryStringWrapper',
  methods: {
    createQueryStringFromObject (queryObject) {
      let queryString = ''

      if (!queryObject) {
        return queryString
      }

      Object.keys(queryObject).map(key => {
        if (!queryString) {
          queryString = `?${key}=${queryObject[key]}`
          return
        }

        queryString = `${queryString}&${key}=${queryObject[key]}`
      })

      return queryString
    }
  },
  render () {
    return this.$scopedSlots.default({
      createQueryStringFromObject: this.createQueryStringFromObject
    })
  }
}
