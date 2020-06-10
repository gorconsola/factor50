<template>
  <div
    class="card"
    :class="type"
  >
    <header
      v-if="title || $slots.header"
      class="card-header"
    >
      <div class="card-header-title is-size-4 is-secondary">
        <b-icon
          v-if="icon"
          class="m-r-8"
          :icon="icon"
          size="is-small"
          type="is-danger"
        />
        <slot name="header">
          {{ title }}
        </slot>
      </div>
    </header>
    <div
      class="card-content"
      :class="{'no-padding': !padding}"
    >
      <div class="content">
        <slot />
      </div>
    </div>
    <footer
      v-if="$slots.footer"
      class="card-footer"
    >
      <slot name="footer" />
    </footer>
  </div>
</template>

<script>
export default {
  name: 'Card',
  props: {
    title: {
      type: String
    },
    padding: {
      type: Boolean,
      default: true
    },
    type: {
      type: String
    },
    icon: {
      type: String
    }
  }
}
</script>

<style lang="scss" scoped>
@import '@/assets/scss/buefy-config.scss';

.card {
  border-radius: 6px;
  box-shadow: $primary-box-shadow;
  height: 100%;
  overflow: hidden;

  &.is-not-streched {
    height: initial;
  }

  hr {
    width: 200%;
    margin-left: -50%;
  }

  .columns {
    width: 100%;
  }
}

.card-header,
.card-footer {
  border: 0;
  padding: 1.5em 1.5em 1.5em 1.5em;
}

.card-header {
  padding: 1.5em 1.5em 0.5em 1.5em;
  box-shadow: none;
}

.card-content {
  padding: 0.5em 1.5em 1.5em 1.5em;

}

.card-content {
  &.no-padding {
    padding: 0;
  }
}

.card-header-title {
  display: flex;
  align-items: center;
  font-weight: 700;
  padding: 0;
}
</style>
