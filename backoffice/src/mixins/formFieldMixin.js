import FieldLabel from '@/components/form/FormComponents/FieldLabel'

const formFieldMixin = () => {
  return {
    components: { FieldLabel },
    computed: {
      errorMessage () {
        return this.errors &&
          this.errors.first(this.name) &&
          this.errors.first(this.name).replace(/_/g, ' ')
      }
    }
  }
}

export default formFieldMixin()
