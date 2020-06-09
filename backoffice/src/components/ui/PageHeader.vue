<template>
  <section class="hero is-hero-bar is-hidden-mobile">
    <div class="hero-body">
      <div class="level">
        <div class="level-left">
          <div class="level-item">
            <h1 class="title">
              {{ title | title }}
            </h1>
          </div>
        </div>

        <div
          v-if="$slots.buttons"
          class="level-right"
        >
          <div class="level-item buttons">
            <slot name="buttons" />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'PageHeader',
  props: {
    title: {
      type: String,
      default: 'Example title'
    },
    subtitle: {
      type: String,
      default: undefined
    }
  }
}
</script>

<style lang="scss" scoped>
  .hero-body {
    padding: 0 2.5em 2em;

    .title {
      font-weight: 600;
      pointer-events: none;
    }
  }
</style>
