const queryStringMixin = () => {
  return {
    methods: {
      updateQueryString (key, value) {
        const query = Object.assign({}, this.$route.query)

        if (!value) {
          delete query[key]
        } else {
          query[key] = value
        }

        this.$router.replace({ query }).catch(err => console.error(err))
      },
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
      },
      getQueryStringFromUrl () {
        return this.createQueryStringFromObject(this.$route.query)
      }
    }
  }
}
export default queryStringMixin()
