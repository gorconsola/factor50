<template>
  <div
    class="multi-select"
    tabindex="-1"
    @focus="toggleShow"
    @focusout="handleOutOfFocus"
  >
    <div class="input is-rounded">
      <span class="placeholder">
        {{ value || 'Pick options' | truncate(maxLength) }}</span>
      <b-icon icon="menu-down" />
    </div>

    <ul
      v-if="show"
      class="drop-down"
    >
      <li
        v-for="(option, index) in options"
        :key="index"
        class="drop-down-item"
        @click="toggleSelected(option)"
      >
        <b-checkbox
          class="checkbox"
          type="is-primary"
          :value="selected && selected.indexOf(option) > -1"
        />

        {{ option }}
      </li>
    </ul>
  </div>
</template>

<script>
import tableFilterMixin from '@/components/table/ChimpTableFilters/TableFilterMixin.js'
import queryStringMixin from '@/components/http/QueryStringMixin.js'

export default {
  name: 'OptionsFilter',
  mixins: [tableFilterMixin, queryStringMixin],
  props: {
    name: {
      type: String,
      required: true
    },
    value: {
      type: String,
      required: true
    },
    options: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      show: false
    }
  },
  computed: {
    maxLength () {
      let length = 0
      this.options.forEach(option => {
        length = option.length > length
          ? option.length
          : length
      })

      return length
    },
    selected () {
      return (this.value && this.value.split(',')) || []
    }
  },
  methods: {
    toggleShow () {
      this.show = !this.show
    },
    toggleSelected (option) {
      const _selected = this.selected
      const index = _selected.indexOf(option)

      if (_selected.indexOf(option) === -1) {
        _selected.push(option)
      } else {
        _selected.splice(index, 1)
      }
      this.$emit('input', _selected.join(','))
      this.updateQueryString(this.name, this.selected.join(','))
    },
    handleOutOfFocus () {
      this.$emit('submit')
      this.toggleShow()
    }
  }
}
</script>

<style lang="scss" scoped>
  .multi-select {
    position: relative;
    outline: none;

    .input {
      display: flex;
      justify-content: space-between;
      max-width: 100%;

      .placeholder {
        font-weight: 400;
        color: rgba(0,0,0,0.2);
        white-space: nowrap;
      }
    }

    .drop-down {
      position: absolute;
      top: 100%;
      left: 1em;
      width: calc(100% - 2em);
      background: white;
      margin: 0;
      padding: 1em 0;
      list-style-type: none;
      box-shadow: 0 1px 2px 0 rgba(30, 32, 42, 0.1);
      z-index: 7331;

      .drop-down-item {
        display: flex;
        align-items: center;
        padding: 0 1em;
        cursor: pointer;

        &:hover {
          background: #eeeeee;
        }

        .checkbox {
          pointer-events: none;
        }
      }
    }
  }
</style>
