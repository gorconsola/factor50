<template>
  <div class="form-field">
    <b-field
      :label="label"
      :message="errorMessage"
      :type="{'is-danger': errors.has(name)}"
      :horizontal="horizontal"
    >
      <b-autocomplete
        v-validate="`${rules}`"
        :name="name"
        :value="value"
        :data="filteredDataArray"
        :placeholder="placeholder"
        :open-on-focus="openFocus"
        @input="handleInput"
      >
        <template slot="empty">
          {{ noResults || 'No results found' }}
        </template>
      </b-autocomplete>
    </b-field>
  </div>
</template>

<script>
import formFieldMixin from '@/mixins/formFieldMixin'

export default {
  name: 'AutoComplete',
  inject: ['$validator'],
  mixins: [formFieldMixin],
  props: [
    'value',
    'name',
    'label',
    'type',
    'placeholder',
    'horizontal',
    'rules',
    'noResults',
    'options',
    'openFocus'
  ],
  data () {
    return {
      searchTerm: ''
    }
  },
  computed: {
    filteredDataArray () {
      return this.options.filter((option) => {
        return option.label
          .toString()
          .toLowerCase()
          .indexOf(this.searchTerm.toLowerCase()) >= 0
      })
    }
  },
  methods: {
    handleInput (value) {
      this.searchTerm = value
      this.$emit('input', value)
    }
  }
}
</script>
