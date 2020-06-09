<template>
  <div class="label-container">
    <span v-if="!!label">{{ label }}</span>
    <span v-if="!!rules" class="label-container__optional">
      <span v-for="(rule, index) in parsedRules" :key="index">{{ rule }}</span>
    </span>
  </div>
</template>

<script>
import { RULES_TO_SHOW } from '@/config/form.config.js'

export default {
  name: 'FieldLabel',
  props: {
    label: {
      type: String,
      required: false
    },
    rules: {
      type: String,
      required: false
    }
  },
  data () {
    return {
      rulesToShow: RULES_TO_SHOW
    }
  },
  computed: {
    parsedRules () {
      return this.rules && this.parseRules(this.rules)
    }
  },
  methods: {
    parseRules (rules) {
      const rulesArray = rules.split('|')

      return rulesArray.filter(rule => {
        return this.rulesToShow.indexOf(rule) !== -1
      })
    }
  }
}
</script>

<style lang="scss" scoped>
  .label-container {
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: flex-end;

    &__optional {
      font-size: 0.75em;
      font-weight: 300;
      color: #CAD0D7;
    }
  }
</style>
