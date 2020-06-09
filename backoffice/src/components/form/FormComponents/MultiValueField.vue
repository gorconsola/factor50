<template>
  <div
    class="form-field column"
    :class="classes">

    <b-field
      :label="dynamicLabel"
      :message="errorMessage"
      :type="{'is-danger': errors.has(name)}"
      :horizontal="horizontal"
    >

      <template slot="label" v-if="label">

        <field-label
          :label="dynamicLabel"
          :rules="rules" />

      </template>

      <template v-if="!singleValue">
        <b-field>
          <b-input
            v-model="optionInput"
            :name="name"
            type="text"
            placeholder="New option"
            @blur="handleBlur"
            expanded />

          <p class="control">
            <button
              @click.prevent="handleSubmit"
              class="button is-primary control"
            >
              Add
            </button>
          </p>
        </b-field>
      </template>

      <template v-else>

        <b-input
          :value="value"
          :name="name"
          expanded
          type="text"
          :placeholder="placeholder"
          v-validate="`${rules}`"
          @blur="handleBlur"
          @input="value => $emit('input', value)" />

      </template>
    </b-field>

    <div class="options" v-if="!singleValue">
      <div
        v-for="(option, index) in options"
        :key="index"
        class="option"
      >
        <span>{{ option }}</span>

        <span @click="removeItem(option)">
          <b-icon
            icon="fas fa-times"
            size="is-small"
            class="close"
             />
        </span>

      </div>
    </div>

  </div>
</template>

<script>
import formFieldMixin from '@/mixins/formFieldMixin'

export default {
  name: 'MultiValueField',
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
    'classes',
    'singleValue'
  ],
  data () {
    return {
      optionInput: ''
    }
  },
  computed: {
    options () {
      return this.value && this.value.split(',')
    },
    dynamicLabel () {
      return this.singleValue
        ? this.label.split(' options')[0]
        : this.label
    }
  },
  methods: {
    handleBlur () {
      this.$emit('blur')
    },
    handleSubmit () {
      const result = this.value
        ? `${this.value},${this.optionInput}`
        : this.optionInput

      this.optionInput = ''
      this.$emit('input', result)
    },
    removeItem (item) {
      const index = this.options.findIndex(i => {
        return i === item
      })

      const _options = [...this.options]

      _options.splice(index, 1)

      const result = _options.length ? _options.toString(',') : ''

      this.$emit('input', result)
    }
  },
  filters: {
    unSnake: function (value) {
      return value.replace('_', ' ')
    }
  }
}
</script>

<style lang="scss" scoped>
  .button {
    &.control {
      padding-top: 0;
      padding-bottom: 0;
      height: 100% !important;
    }
  }
  .option {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5em;

    &:nth-of-type(odd) {
      background: #F4F6F8;
    }

    .close {
      cursor: pointer;
    }
  }
</style>
