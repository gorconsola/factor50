<template>
  <div>
    <div class="section">
      <slot>
        <card>
          <template v-slot:header>
            {{ title }}
          </template>
        </card>
      </slot>
    </div>
  </div>
</template>

<script>
import Card from '@/components/ui/Card.vue'

export default {
  name: 'ProductDetailLayout',
  components: {
    Card
  },
  props: {
    title: {
      type: String,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
</style>
