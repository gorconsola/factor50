const tableFilterMixin = () => {
  return {
    data () {
      return {
        hasChanged: false
      }
    },
    methods: {
      toggleHasChanged (value = 'empty') {
        if (value !== 'empty') {
          this.hasChanged = value
          return true
        }

        this.hasChanged = !this.hasChanged
      },
      handleBlur () {
        if (this.hasChanged) {
          this.$emit('submit')
          this.toggleHasChanged(false)
        }
      }
    }
  }
}
export default tableFilterMixin()
