<template>
  <div class="min-max-filter">
    <input-field
      class="first-input"
      :name="name"
      :value="min"
      classes="no-padding"
      placeholder="From"
      type="number"
      @input="minInput"
      @blur="handleBlur"
    />

    <input-field
      :name="name"
      :value="max"
      placeholder="To"
      type="number"
      @input="maxInput"
      @blur="handleBlur"
    />
  </div>
</template>

<script>
import InputField from '@/components/form/FormComponents/InputField.vue'
import tableFilterMixin from '@/components/table/ChimpTableFilters/TableFilterMixin.js'
import queryStringMixin from '@/components/http/QueryStringMixin.js'

export default {
  name: 'MinMaxFilter',
  components: { InputField },
  mixins: [tableFilterMixin, queryStringMixin],
  props: {
    name: {
      type: String,
      required: true
    },
    value: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      min: this.setMin() || '',
      max: this.setMax() || ''
    }
  },
  computed: {
    resultString () {
      return this.min || this.max
        ? `${this.min}-${this.max}`
        : ''
    }
  },
  methods: {
    setMin () {
      return this.value && this.value.split('-')[0]
    },
    setMax () {
      return this.value &&
        this.value.split('-').length > 1 &&
        this.value.split('-')[1]
    },
    minInput (value) {
      this.toggleHasChanged(true)

      this.min = value
      this.$emit('input', this.resultString)
      this.updateQueryString(this.name, this.resultString)
    },
    maxInput (value) {
      this.toggleHasChanged(true)

      this.max = value
      this.$emit('input', this.resultString)
      this.updateQueryString(this.name, this.resultString)
    }
  }
}
</script>

<style lang="scss" scoped>
  .min-max-filter {
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    .first-input {
      margin-bottom: 3px;
    }
  }
</style>
